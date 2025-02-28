<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointment = Appointment::with('barber')->get();
        return response()->json($appointment, 200, options: JSON_UNESCAPED_UNICODE);
    }
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'barber_id' => 'required|integer|exists:barbers,id',
                    'appointment' => 'required|date'
                ],
                [
                    'required' => 'A(z) :attribute mező megadása kötelező!',
                    'string' => 'A(z) :attribute mezőnek szöveg típusúnak kell lennie!',
                    'max' => 'A(z) :attribute mező túl hosszú. Max :max',
                    'date' => 'A(z) :attribute mezőnek datetime típusúnak kell lennie.',
                    'integer' => 'A(z) :attribute mezőnek integer típusúnak kell lennie',
                    'exists' => 'Nem létezik barber ezzel az id-val'
                ]
            );
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 400, options: JSON_UNESCAPED_UNICODE);
        }

        $appointment = Appointment::create($request->all());
        return response()->json(['success' => true, 'message' => $appointment->name . " névvel időpont sikeresen rögzítve!"], 200, options: JSON_UNESCAPED_UNICODE);
    }
    public function destroy(Request $request)
    {
        try {
            $request->validate(
                [
                    "id" => 'required|integer|exists:appointments,id'
                ],
                [
                    'required' => 'A(z) :attribute mező megadása kötelező!',
                    'integer' => 'A(z) :attribute mezőnek integer típusúnak kell lennie',
                    'exists' => 'Nem létezik appointment ezzel az id-val'
                ]
            );
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 400, options: JSON_UNESCAPED_UNICODE);
        }

        try{
            $appointment = Appointment::findOrFail($request->id);
            $appointment->delete();
        }
        catch(Exception $e)
        {
            return response()->json(['success' => false, 'message' => $e], 400, options: JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['success' => true, 'message' => "Időpont sikeresen törölve!"], 200, options: JSON_UNESCAPED_UNICODE);
    }
}
