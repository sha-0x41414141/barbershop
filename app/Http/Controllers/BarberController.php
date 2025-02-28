<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;

class BarberController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
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

        $barber = Barber::create($request->all());
        return response()->json(['success' => true, 'message' => $barber->barber_name . " barber sikeresen rögzítve"], 200);
    }

    public function destroy()
    {

    }
}
