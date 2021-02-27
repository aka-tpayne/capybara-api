<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Capybara;
use App\Models\CapybaraObservation;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CapybaraObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'seen_on' => 'required|date_format:Y-m-d',
            'city' => 'required|string',
            'wearing_hat' => 'boolean'
        ]);

        $interested_cities = [
            'Chicago',
            'Atlanta',
            'New York',
            'Houston',
            'San Francisco',
        ];
        if (!in_array($validated['city'], $interested_cities)) {
            abort(422, "We currently aren't interested in capybara observations in {$validated['city']}.");
        }

        $capybara = Capybara::where('name', $validated['name'])->first();
        if (!$capybara) {
            abort(422, "A capybara by the name of {$validated['name']} doesn't exist in the system.");
        }

        // Check if observation exists already
        $existing_observation = $capybara->observations()->where(Arr::except($validated, ['name', 'wearing_hat']))->count();
        if ($existing_observation > 0) {
            abort(422, "{$capybara->name} has already been observed in {$validated['city']} on {$validated['seen_on']}.");
        }

        $capybara->observations()->create(Arr::except($validated, 'name'));
        
        return response()->json(['created' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
