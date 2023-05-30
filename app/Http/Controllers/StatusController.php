<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $filteredAppointments = Appointment::with('user')->latest()->paginate(5);
         return view('admin.management.status.index', compact('filteredAppointments'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'status' => 'required|in:Pending Approval,Booking Confirmed,Completed',
            ]);

            // Find the appointment by ID
            $appointment = Appointment::findOrFail($id);

            // Update the status field
            $appointment->status = $request->input('status');
            $appointment->save();

            // Return a response indicating the successful update
            return response()->json(['success' => 'Appointment status updated successfully']);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Appointment status update failed: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Appointment status updated successfully'], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
