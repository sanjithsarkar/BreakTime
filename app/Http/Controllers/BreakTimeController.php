<?php

namespace App\Http\Controllers;

use App\Models\BreakTime;
use Illuminate\Http\Request;

class BreakTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $request->validate([
        //     'emp_id' => 'required|string|max:255',
        //     'break_in' => 'required|string|max:255|unique:'.BreakTime::class,
        // ]);

        // $user = BreakTime::create([
        //     'emp_id' => $request->emp_id,
        //     'break_in' => $request->break_in,
        // ]);

        // return redirect();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BreakTime $breakTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BreakTime $breakTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BreakTime $breakTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BreakTime $breakTime)
    {
        //
    }
}
