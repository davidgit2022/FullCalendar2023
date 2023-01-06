<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = array();
        $eventos = Evento::all();
        foreach($eventos as $evento) {
            $color = null;
            if($evento->title == 'Test') {
                $color = '#924ACE';
            }
            if($evento->title == 'Test 1') {
                $color = '#68B01A';
            }

            $events[] = [
                'id'   => $evento->id,
                'title' => $evento->title,
                'description' => $evento->description,
                'start' => $evento->start,
                'end' => $evento->end,
                'color' => $color
            ];
        }
        return view('evento.evento', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /* $request->validate([
            'title' => 'required|string'
        ]); */

        $evento = Evento::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        /* $color = null;

        if($evento->title == 'Test') {
            $color = '#924ACE';
        } */

        return response()->json([
            'id' => $evento->id,
            'title' => $evento->title,
            'description' => $evento->description,
            'start' => $evento->start,
            'end' => $evento->end_date,

            /* 'color' => $color ? $color: '', */

        ]);
    }

    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
