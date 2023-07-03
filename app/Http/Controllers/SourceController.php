<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sources = Source::latest()->get();
        return view('admin.management.sources.index', compact('sources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.management.sources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $source = Source::create($request->all());

        if ($source) {
            return redirect()->route('sources.index')->with('success', 'Source created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create Source.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Source $source)
    {
        return view('admin.management.sources.edit', compact('source'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Source $source)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $source->update($request->all());

        return redirect()->route('sources.index')->with('success', 'Source name updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Source $source)
    {
        $source->delete();

        return redirect()->route('sources.index')->with('success', 'Source deleted successfully');
    }
}
