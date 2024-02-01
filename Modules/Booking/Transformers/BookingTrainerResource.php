<?php

namespace Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Service\Models\Service;
use Modules\Service\Transformers\ServiceResource;
use Modules\Service\Transformers\SystemServiceResource;


class BookingTrainerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $tax_details =calculateTaxAmounts($this->payment?$this->payment->tax_percentage:null, ($this->service_amount));
        $response = [
            'id' => $this->id,
            'note' => $this->note,
            'status' => $this->status,
            'start_date_time' => $this->start_date_time,
            'pet_name' => optional($this->pet)->name,
            'breed' => optional(optional($this->pet)->breed)->name,
            'pet_image' => optional($this->pet)->getFirstMediaUrl('pet_image'),
            'service' => new SystemServiceResource($this->systemservice),
            'employee_id' => $this->employee_id,
            'employee_name' => optional($this->employee)->first_name . " ". optional($this->employee)->last_name,
            'employee_image' => optional($this->employee)->getFirstMediaUrl('profile_image'),
            'payment' => new PaymentResource($this->payment),
            'customer_id' => $this->user_id,
            'customer_name' => optional($this->user)->first_name . " ". optional($this->user)->last_name,
            'customer_contact' => optional($this->user)->mobile,
            'customer_image' => optional($this->user)->getFirstMediaUrl('profile_image'),
            'taxes'=> $tax_details,
            'total_amount'=>(($this->service_amount)+TaxCalculation($this->service_amount ? $this->service_amount : 0))

        ];
        $response['trainings'] = [];
        foreach ($this->training as $training) {
            $response['trainings'][] = [
                'id' => optional($training)->id,
                'price' => optional($training)->price,
                'date_time' => optional($training)->date_time,
                'training' => optional($training)->trainingtype,
                'duration' => optional($training)->duration,
                'status' => optional($training)->status,
            ];
        }
        return $response;
    }
}
