<?php

namespace App\Http\Controllers;

use App\Models\Tenancy;
use App\Http\Requests\StoreTenancyRequest;
use App\Http\Requests\UpdateTenancyRequest;

class TenancyController extends Controller
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
     * @param  \App\Http\Requests\StoreTenancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenancyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenancy  $tenancy
     * @return \Illuminate\Http\Response
     */
    public function show(Tenancy $tenancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenancy  $tenancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenancy $tenancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTenancyRequest  $request
     * @param  \App\Models\Tenancy  $tenancy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTenancyRequest $request, Tenancy $tenancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenancy  $tenancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenancy $tenancy)
    {
        //
    }
}
