<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use App\Imports\VehicleImports;
use Maatwebsite\Excel\Facades\Excel;
class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(5);
        return view('admin.management.vehicle.index', compact('vehicles'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function importData(Request $request)
    {
        $file = $request->file('import_vehicle');

        Excel::import(new VehicleImports, $file);

        // Optionally, you can redirect or return a response
        return redirect()->back()->with('success', 'Data imported successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.management.vehicle.create');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
