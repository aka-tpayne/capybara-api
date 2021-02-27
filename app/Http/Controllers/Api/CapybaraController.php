<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Capybara;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CapybaraController extends Controller
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
            'name' => 'bail|required|string|unique:App\Models\Capybara',
            'size' => 'required|string',
            'color' => 'required|string',
        ]);

        $capybara = Capybara::create($validated);

        return response()->json(['created' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capybara  $capybara
     * @return \Illuminate\Http\Response
     */
    public function show(Capybara $capybara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capybara  $capybara
     * @return \Illuminate\Http\Response
     */
    public function edit(Capybara $capybara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capybara  $capybara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capybara $capybara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capybara  $capybara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capybara $capybara)
    {
        //
    }
}
