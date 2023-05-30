<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Models\VehicleModel;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filteredAppointments = Appointment::with('user')->latest()->paginate(5);
        return view('appointments.index', compact('filteredAppointments'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleMakes = Vehicle::distinct('name')->get(['name']);
        return view('appointments.create', compact('vehicleMakes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'req_name' => 'required',
            'req_designation' => 'required',
            'req_contact' => 'required',
            'apt_date' => 'required',
            'apt_time' => 'required',
            'pickup_location' => 'required',
            'pickup_lat' => 'required',
            'pickup_long' => 'required',
            'pickup_url' => 'required',
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'customer_vrn' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'dropoff_location' => 'required',
            'dropoff_lat' => 'required',
            'dropoff_long' => 'required',
            'dropoff_url' => 'required',
            'special_notes' => 'required',
            'status' => 'required',

        ]);

        $appointment = Appointment::create($request->all());

        if ($appointment) {
            return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create appointment.');
        }

}

    /**
     * Display the specified resource.
     */
    public function show($appointment)
    {
        $id = $appointment;
        $appointment = Appointment::find($id);

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'user_id' => 'required',
            'req_name' => 'required',
            'req_designation' => 'required',
            'req_contact' => 'required',
            'apt_date' => 'required',
            'apt_time' => 'required',
            'pickup_location' => 'required',
            'pickup_lat' => 'required',
            'pickup_long' => 'required',
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'customer_vrn' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'dropoff_location' => 'required',
            'dropoff_lat' => 'required',
            'dropoff_long' => 'required',
            'special_notes' => 'required',
            'status' => 'required',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }
}
