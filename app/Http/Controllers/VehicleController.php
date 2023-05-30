<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use App\Imports\VehicleImports;
use PhpOffice\PhpSpreadsheet\IOFactory;
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

        if (request()->hasFile('import_vehicle')) {
            set_time_limit(300);
            $file = request()->file('import_vehicle');
            $spreadsheet = IOFactory::load($file);

            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            $vehicleNames = $data[0]; // Get the first row as vehicle names

            // Import vehicles and vehicle models
            foreach ($vehicleNames as $column => $vehicleName) {
                if (empty($vehicleName)) {
                    continue; // Skip empty vehicle names
                }

                // Check if the vehicle already exists
                $vehicle = Vehicle::where('name', $vehicleName)->first();

                if (!$vehicle) {
                    $vehicleData = [
                        'name' => $vehicleName,
                    ];

                    $vehicle = Vehicle::create($vehicleData);
                }

                // Iterate over the remaining rows (vehicle model data)
                for ($row = 1; $row < count($data); $row++) {
                    $vehicleModelName = $data[$row][$column];

                    if (!empty($vehicleModelName)) {
                        // Check if the vehicle model already exists
                        $existingModel = VehicleModel::where('vehicle_id', $vehicle->id)
                            ->where('name', $vehicleModelName)
                            ->first();

                        if (!$existingModel) {
                            $vehicleModelData = [
                                'vehicle_id' => $vehicle->id,
                                'name' => $vehicleModelName,
                                // Add more columns as necessary
                            ];

                            VehicleModel::create($vehicleModelData);
                        }
                    }
                }
            }

            // Optionally, you can redirect or return a response
            return redirect()->back()->with('success', 'Data imported successfully.');
        } else {
            return redirect()->back()->with('error', 'Data not imported.');
        }
    }


    public function getVehicleModels(Request $request)
    {
        $vehicleMake = $request->input('vehicle_make'); // Get the selected vehicle make

        // Query the vehicle models based on the selected vehicle make, if available
        $query = VehicleModel::query();
        if ($vehicleMake) {
            $query->whereHas('vehicle', function ($q) use ($vehicleMake) {
                $q->where('name', $vehicleMake);
            });
        }

        $vehicleModels = $query->get();

        return response()->json($vehicleModels);
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
