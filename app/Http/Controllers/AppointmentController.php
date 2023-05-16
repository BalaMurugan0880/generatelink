<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $appointments = Appointment::latest()->paginate(5);
        // return view('appointments.index', compact('appointments'))->with('i', (request()->input('page', 1) - 1) * 5);
        $user = Auth::user();
        // dd($user->access_token);
        $response = Http::withOptions([
            'verify' => false
        ])
        ->withBasicAuth('C54B5730DF624A58AF77C319FCE2FA93', '285eb345f5c6dbbc3d0d17f7350f039deedce7b6')
        ->withHeaders(['Access-Token' => $user->access_token])
        ->get('https://api.staging.europ-assistance.my/api/bookings');


        if ($response->successful()) {
        $appointments = $response->json();

        // dd($appointments);
        $serviceId = 24; // Replace with the service ID you want to filter
        $filteredAppointments = array_filter($appointments, function ($appointment) use ($serviceId) {
            return $appointment['serviceId'] == $serviceId;
        });




        return view('appointments.index', compact('filteredAppointments'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
        // Handle the API request failure
        $errorMessage = $response->json()['message'];
        return view('error', compact('errorMessage'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointments.create');
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
        ]);

        Appointment::create($request->all());


        $client = new Client([
            'base_uri' => 'https://api.staging.europ-assistance.my',
            'auth' => ['C54B5730DF624A58AF77C319FCE2FA93', '285eb345f5c6dbbc3d0d17f7350f039deedce7b6'],
            'verify' => false, // enable SSL/TLS certificate verification
        ]);


        $bookingDate = now()->toIso8601ZuluString();
        $user = Auth::user();

        $data = [
            "serviceId" => 24,
            "bookingDate" => $bookingDate,
            "quantity" => 1,
            "applicationFields" => htmlspecialchars(json_encode([
                'user_id' => $request->input('user_id'),
                'req_name' => $request->input('req_name'),
                'req_designation' => $request->input('req_designation'),
                'req_contact' => $request->input('req_contact'),
                'apt_date' => $request->input('apt_date'),
                'apt_time' => $request->input('apt_time'),
                'pickup_location' => $request->input('pickup_location'),
                'pickup_lat' => $request->input('pickup_lat'),
                'pickup_long' => $request->input('pickup_long'),
                'pickup_url' => $request->input('pickup_url'),
                'customer_name' => $request->input('customer_name'),
                'customer_contact' => $request->input('customer_contact'),
                'customer_vrn' => $request->input('customer_vrn'),
                'vehicle_make' => $request->input('vehicle_make'),
                'vehicle_model' => $request->input('vehicle_model'),
                'dropoff_location' => $request->input('dropoff_location'),
                'dropoff_lat' => $request->input('dropoff_lat'),
                'dropoff_long' => $request->input('dropoff_long'),
                'dropoff_url' => $request->input('dropoff_url'),
                'special_notes' => $request->input('special_notes')
            ]))
        ];

        $response = $client->post('/api/bookings', [
            'headers' => [
                'Access-Token' => $user->access_token,
                'Content-Type' => 'application/json'
            ],
            'json' => $data
        ]);

        $responseBody = $response->getBody()->getContents();


        // dd($response);

        if ($response->getStatusCode() === 200) {
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
        $user = Auth::user();
        // dd($user->access_token);
        $response = Http::withOptions([
            'verify' => false
        ])
        ->withBasicAuth('C54B5730DF624A58AF77C319FCE2FA93', '285eb345f5c6dbbc3d0d17f7350f039deedce7b6')
        ->withHeaders(['Access-Token' => $user->access_token])
        ->get('https://api.staging.europ-assistance.my/api/bookings');


        if ($response->successful()) {
        $appointments = $response->json();


        // dd($appointments);
        $id = $appointment;
        $filteredAppointment = array_filter($appointments, function ($appointment) use ($id) {
            return $appointment['id'] == $id;
        });
    }

    // dd($filteredAppointment);


        return view('appointments.show', compact('filteredAppointment'));
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
