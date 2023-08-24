<?php

namespace App\Http\Controllers;

use App\Models\Batu;
use App\Http\Requests\StoreBatuRequest;
use App\Http\Requests\UpdateBatuRequest;

class BatuController extends Controller
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
     * @param  \App\Http\Requests\StoreBatuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBatuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function show(Batu $batu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function edit(Batu $batu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBatuRequest  $request
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBatuRequest $request, Batu $batu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batu  $batu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batu $batu)
    {
        //
    }
}
