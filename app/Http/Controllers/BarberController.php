<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use Illuminate\Validation\ValidationException;

class BarberController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        return response()->json($barbers, 200, options: JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        try{
            $request->validate(
                [
                    'barber_name' => 'required|string|max:255'
                ],
                [
                    'required' => 'A(z) :attribute mező megadása kötelező!',
                    'string' => 'A(z) :attribute mezőnek szöveg típusúnak kell lennie!',
                    'max' => 'A(z) :attribute mező túl hosszú. Max :max'
                ]
            );
        }
        catch(ValidationException $e)
        {
            return response()->json(['success' => false, 'message' => $e->errors()], 400, options: JSON_UNESCAPED_UNICODE);
        }
        
        $barber = Barber::create($request->all());
        return response()->json(['success' => true, 'message' => $barber->barber_name . " barber sikeresen rögzítve"], 200, options: JSON_UNESCAPED_UNICODE);
    }

    public function destroy()
    {

    }
}
