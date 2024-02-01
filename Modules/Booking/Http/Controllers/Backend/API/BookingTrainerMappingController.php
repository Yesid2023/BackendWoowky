<?php

namespace Modules\Booking\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\BookingTrainerMapping;
use Modules\Service\Models\Service;
use Modules\Service\Models\ServiceTraining;

class BookingTrainerMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationArray = [
            'date_time' => 'required|date',
            'price' => 'required|numeric',
            'duration'=>'required|string',
            'booking_id' => 'required|exists:bookings,id'
        ];
        $request->validate($validationArray);

        $booking = Booking::withCount('training')->find($request->booking_id);

        $training_type = BookingTrainerMapping::with('trainingtype')
                            ->where('booking_id', $request->booking_id)
                            ->first()->trainingtype;

        if($booking->training_count >= $training_type->sessions){
            return response()->json([
                'status' => 'error',
                'message' => 'You can not add more training',
                'data' => []
            ], 422);
        }

        $training = [
            'date_time' => $request->date_time,
            'training_id' => $training_type->id,
            'price' => $request->price,
            'duration'=>$request->duration,
            'booking_id' => $booking->id
        ];
        BookingTrainerMapping::create($training);

        return response()->json([
            'status' => 'success',
            'message' => 'Training added successfully',
            'data' => $training
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(empty($request->status)){
            return response()->json([
                'status' => 'error',
                'message' => 'Status is required',
                'data' => []
            ], 422);
        }

        $trainnig = BookingTrainerMapping::find($id);
        $trainnig->status = $request->status;
        $trainnig->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Training status updated successfully',
            'data' => $trainnig
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
