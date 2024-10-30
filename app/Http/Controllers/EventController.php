<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::select('events.*', 'cities.name as city')
            ->join('cities', 'cities.id', '=', 'events.city_id') // Cambiado 'cities_id' a 'city_id'
            ->paginate(10);
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:100',
            'datei' => 'required|date',
            'datef' => 'required|date',
            'promo' => 'nullable|image', // Cambiado a nullable si no es obligatorio
            'city_id' => 'required|exists:cities,id' // Asegúrate de que la ciudad exista
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        try {
            $event = new Event($request->all());
            $event->save();
            return response()->json([
                'status' => true,
                'message' => 'Event created successfully'
            ], 201); // Cambié el código de respuesta a 201 (Creado)
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error adding event: ' . $e->getMessage()
            ], 500); // Errores del servidor
        }
    }

    public function show(Event $event)
    {
        return response()->json(['status' => true, 'data' => $event]);
    }

    public function update(Request $request, Event $event)
    {
        $rules = [
            'name' => 'required|string|min:1|max:100',
            'datei' => 'required|date',
            'datef' => 'required|date',
            'promo' => 'nullable|image', // Cambiado a nullable si no es obligatorio
            'city_id' => 'required|exists:cities,id' // Asegúrate de que la ciudad exista
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        try {
            $event->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Event updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating event: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return response()->json([
                'status' => true,
                'message' => 'Event deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting event: ' . $e->getMessage()
            ], 500);
        }
    }

    public function EventsByCity()
    {
        $events = Event::select(DB::raw('count(events.id) as count, cities.name'))
            ->rightJoin('cities', 'cities.id', '=', 'events.city_id') // Cambiado 'cities_id' a 'city_id'
            ->groupBy('cities.name')
            ->get();
        return response()->json($events);
    }

    public function all()
    {
        $events = Event::select('events.*', 'cities.name as city')
            ->join('cities', 'cities.id', '=', 'events.city_id') // Cambiado 'cities_id' a 'city_id'
            ->get();
        return response()->json($events);
    }
}
