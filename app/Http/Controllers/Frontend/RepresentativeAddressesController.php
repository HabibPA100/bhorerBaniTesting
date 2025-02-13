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
            'representative_id' => 'required|exists:representatives,id',
            'permanent_district' => 'required|string|max:255',
            'permanent_sub_district' => 'required|string|max:255',
            'permanent_municipality' => 'required|string|max:255',
            'permanent_ward' => 'required|string|max:10',
            'permanent_post_code' => 'required|string|max:10',
            'permanent_village_locality' => 'required|string|max:255',
            'permanent_house_road_number' => 'required|string|max:255',
    
            'current_district' => 'required|string|max:255',
            'current_sub_district' => 'required|string|max:255',
            'current_municipality' => 'required|string|max:255',
            'current_ward' => 'required|string|max:10',
            'current_post_code' => 'required|string|max:10',
            'current_village_locality' => 'required|string|max:255',
            'current_house_road_number' => 'required|string|max:255',
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
            'representative_id' => 'required|exists:representatives,id',
            'permanent_district' => 'required|string|max:255',
            'permanent_sub_district' => 'required|string|max:255',
            'permanent_municipality' => 'required|string|max:255',
            'permanent_ward' => 'required|string|max:10',
            'permanent_post_code' => 'required|string|max:10',
            'permanent_village_locality' => 'required|string|max:255',
            'permanent_house_road_number' => 'required|string|max:255',
    
            'current_district' => 'required|string|max:255',
            'current_sub_district' => 'required|string|max:255',
            'current_municipality' => 'required|string|max:255',
            'current_ward' => 'required|string|max:10',
            'current_post_code' => 'required|string|max:10',
            'current_village_locality' => 'required|string|max:255',
            'current_house_road_number' => 'required|string|max:255',
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
