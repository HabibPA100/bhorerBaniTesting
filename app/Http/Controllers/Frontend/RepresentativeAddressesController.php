<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use App\Models\RepresentativeAddress;
use Illuminate\Http\Request;

class RepresentativeAddressesController extends Controller
{
    // Display a listing of the resource.
    public function index($representative_id)
    {
        $representative = Representative::findOrFail($representative_id);
        $addresses = $representative->address;
        return view('representative_addresses.index', compact('addresses', 'representative'));
    }

    // Show the form for creating a new resource.
    public function create($representative_id)
    {
        $representative = Representative::findOrFail($representative_id);
        return view('representative_addresses.create', compact('representative'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request, $representative_id)
    {
        $request->validate([
            'permanent_district' => 'required',
            'current_district' => 'required',
            // other validation rules
        ]);

        $address = new RepresentativeAddress($request->all());
        $address->representative_id = $representative_id;
        $address->save();

        return redirect()->route('representatives.show', $representative_id);
    }

    // Display the specified resource.
    public function show($id)
    {
        $address = RepresentativeAddress::findOrFail($id);
        return view('representative_addresses.show', compact('address'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $address = RepresentativeAddress::findOrFail($id);
        $representative = $address->representative;
        return view('representative_addresses.edit', compact('address', 'representative'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'permanent_district' => 'required',
            'current_district' => 'required',
            // other validation rules
        ]);

        $address = RepresentativeAddress::findOrFail($id);
        $address->update($request->all());
        $address->save();

        return redirect()->route('representatives.show', $address->representative_id);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $address = RepresentativeAddress::findOrFail($id);
        $address->delete();

        return redirect()->route('representatives.show', $address->representative_id);
    }
}
