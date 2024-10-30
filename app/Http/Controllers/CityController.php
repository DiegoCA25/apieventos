<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) { // Corrección aquí
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        try {
            $city = new City($request->input());
            $city->save();
            return response()->json([
                'status' => true,
                'message' => 'City added successfully' // Corrección aquí
            ], 201); // 201 para creación exitosa
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error adding city: ' . $e->getMessage()
            ], 500); // 500 para errores de servidor
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return response()->json(['status' => true, 'data' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $rules = ['name' => 'required|string|min:1|max:100'];
        $validator = \Validator::make($request->input(), $rules);
        if ($validator->fails()) { // Corrección aquí
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        try {
            $city->update($request->input());
            return response()->json([
                'status' => true,
                'message' => 'City updated successfully' // Corrección aquí
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating city: ' . $e->getMessage()
            ], 500); // 500 para errores de servidor
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        try {
            $city->delete();
            return response()->json([
                'status' => true,
                'message' => 'City deleted successfully' // Corrección aquí
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting city: ' . $e->getMessage()
            ], 500); // 500 para errores de servidor
        }
    }
}

