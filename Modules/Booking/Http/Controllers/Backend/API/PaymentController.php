<?php

namespace Modules\Booking\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\BookingTransaction;
use Modules\Booking\Trait\PaymentTrait;
use Modules\Tip\Models\TipEarning;
use Modules\Commission\Models\CommissionEarning;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    use PaymentTrait;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Payment';
    }

    public function savePayment(Request $request)
    {

        $data = $request->all();
        $data['tip_amount'] = $data['tip'] ?? 0;

        $booking = Booking::where('id', $data['booking_id'])->first();

        $payment = BookingTransaction::updateOrCreate(['id' => $data['id']], $data);

        if ($booking['employee_id'] != '') {

            $earning_data = $this->commissionData($payment);

            $booking->commission()->save(new CommissionEarning($earning_data['commission_data']));

            if ($data['tip_amount'] > 0) {

                $booking->tip()->save(new TipEarning($earning_data['tip_data']));
            }
        }


        $message = __('booking.payment_done');

        return response()->json(['message' => $message, 'status' => true], 200);
    }

    public function wompiPayment(Request $request)
    {
        $validatedData = $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
            'payment_method' => 'required|string|in:CARD,BANCOLOMBIA_TRANSFER,BANCOLOMBIA_QR,NEQUI,PSE',
            'token' => 'required_if:payment_method,CARD',
            'phone_number' => 'required_if:payment_method,NEQUI',
            'user_type' => 'required_if:payment_method,PSE,BANCOLOMBIA_TRANSFER',
            'user_legal_id_type' => 'required_if:payment_method,PSE',
            'user_legal_id' => 'required_if:payment_method,PSE',
            'financial_institution_code' => 'required_if:payment_method,PSE',
        ]);

        $client = new Client();
        $acceptance_token = $client->request(
            'GET',
            'https://sandbox.wompi.co/v1/merchants/pub_test_rbHh9GcFhH28AUuNSWt9ztnKHZqUmu4r',
            [
                'headers' => [
                    'Authorization' => 'Bearer tu_llave_publica',
                    'Content-Type' => 'application/json',
                ],
            ]
        );

        $acceptance_token = json_decode($acceptance_token->getBody()->getContents(), true);
        $acceptance_token = $acceptance_token['data']['presigned_acceptance']['acceptance_token'];

        $data = $request->all();

        $booking = Booking::with(['user', 'systemservice'])->where('id', $data['booking_id'])->first();

        switch ($data['payment_method']) {
            case 'CARD':
                $payment_method = [
                    'type' => 'CARD',
                    'token' => $data['token'],
                    'installments' => 1,
                ];
                break;
            case 'BANCOLOMBIA_TRANSFER':
                $payment_method = [
                    'type' => 'BANCOLOMBIA_TRANSFER',
                    'user_type' => "PERSON",
                    'payment_description' => "Pago de {$booking['systemservice']['name']}",
                    'sandbox_status' => 'APPROVED',
                    'ecommerce_url' => "https://woowky.com"
                ];
                break;
            case 'BANCOLOMBIA_QR':
                $payment_method = [
                    'type' => 'BANCOLOMBIA_QR',
                    'payment_description' => "Pago de {$booking['systemservice']['name']}",
                    'SANDBOX_STATUS' => 'APPROVED',
                ];
                break;
            case 'NEQUI':
                $payment_method = [
                    'type' => 'NEQUI',
                    'phone_number' => $data['phone_number'],
                ];
                break;
            case 'PSE':
                $payment_method = [
                    'type' => 'PSE',
                    'user_type' => $data['user_type'],
                    'user_legal_id_type' => $data['user_legal_id_type'],
                    'user_legal_id' => $data['user_legal_id'],
                    'financial_institution_code' => $data['financial_institution_code'],
                    'payment_description' => "Pago de {$booking['systemservice']['name']}",
                    'return_url' => "https://woowky.com"
                ];
                break;
            default:
                $payment_method = [
                    'type' => 'CARD',
                    'token' => $data['token'],
                ];
                break;
        }

        $transaction = $client->request('POST', 'https://sandbox.wompi.co/v1/transactions', [
            'json' => [
                'acceptance_token' => $acceptance_token,
                'amount_in_cents' => $booking['total_amount'] * 100,
                'currency' => 'COP',
                'customer_email' => 'test@wompi.co',
                'payment_method' => $payment_method,
                'reference' => "{$booking->id}",
            ],
            'headers' => [
                'Authorization' => 'Bearer pub_test_rbHh9GcFhH28AUuNSWt9ztnKHZqUmu4r',
                'Content-Type' => 'application/json',
            ],
        ]);
        $transaction = json_decode($transaction->getBody()->getContents(), true);
        $transaction_id = $transaction['data']['id'];

        if ($data['payment_method'] == 'BANCOLOMBIA_TRANSFER' || $data['payment_method'] == 'PSE') {
            $linkPay = null;
            $status = 0;

            while ($status != 200 || is_null($linkPay)) {
                $response = $client->request('GET', "https://sandbox.wompi.co/v1/transactions/{$transaction_id}");
                $status = $response->getStatusCode();

                if ($status == 200) {
                    $data = json_decode($response->getBody()->getContents(), true);
                    $linkPay = $data['data']['payment_method']['extra']['async_payment_url'] ?? null;
                }

                // Espera antes de hacer la próxima solicitud
                sleep(1);
            }

            return response()->json(['link' => $linkPay, 'status' => true], 200);
        }

        if ($data['payment_method'] == 'BANCOLOMBIA_QR') {
            $qr_image = null;
            $status = 0;

            while ($status != 200 || is_null($qr_image)) {
                $response = $client->request('GET', "https://sandbox.wompi.co/v1/transactions/{$transaction_id}");
                $status = $response->getStatusCode();

                if ($status == 200) {
                    $data = json_decode($response->getBody()->getContents(), true);
                    $qr_image = $data['data']['payment_method']['extra']['qr_image'] ?? null;
                }

                // Espera antes de hacer la próxima solicitud
                sleep(1);
            }

            return response()->json(['qr_image' => $qr_image, 'status' => true], 200);
        }



        $message = __('booking.payment_done');

        return response()->json(['message' => $message, 'status' => true], 200);
    }

    public function wompiNotification(Request $request)
    {
        $data = $request->all();

        $booking = Booking::where('id', $data['data']['transaction']['reference'])->first();

        if ($data['data']['transaction']['status'] == 'APPROVED') {
            BookingTransaction::where('booking_id', $booking->id)->update(['payment_status' => 1]);
            if ($booking->status == 'completed') {

                CommissionEarning::where('commissionable_id', $booking->id)->update(['commission_status' => 'unpaid']);
            }
        }



        $message = __('booking.payment_done');

        return response()->json(['message' => $message, 'status' => true], 200);
    }
}
