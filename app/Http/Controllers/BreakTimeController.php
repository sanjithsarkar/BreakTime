<?php

namespace App\Http\Controllers;

use App\Models\BreakTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BreakTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage');
        $breaks = BreakTime::paginate(request()->perPage ?? ($perPage ?? 5));
        return Inertia::render('Break/Index')->with('breaks', $breaks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Break/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'emp_id' => 'required|numeric|max:255',
            'break_type' => 'required|string|max:255',
        ]);

        $date = Carbon::now();
        $formattedDate = $date->format('d/m/Y H:i:s');

        $user = BreakTime::create([
            'emp_id' => $request->emp_id,
            'break_type' => $request->break_type,
            'break_in' => $formattedDate,
            'status' => 0,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(BreakTime $breakTime)
    {
        // return Inertia::render('Break/Create')->with('breakTime', $breakTime);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BreakTime $breakTime, Request $request)
    {
        return Inertia::render('Break/Create')->with('breakTime', $breakTime);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BreakTime $breakTime)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BreakTime $breakTime)
    {
        //
    }

    public function updateBreak(Request $request){

        // dd($request->all());
        $validate = $request->validate([
            'emp_id' => 'required|numeric|max:255',
            'break_type' => 'required|string|max:255',
        ]);

        if($validate->fail())

        $date = Carbon::now();
        $formattedDate = $date->format('d/m/Y H:i:s');
        $empId = $request->emp_id;

        $isExit = BreakTime::where('emp_id', $empId)->where('status', 0)->first();

        if($isExit){
            $data = array();
            $data['break_end'] = $formattedDate;
            $data['status'] = 1;
            DB::table('break_times')->where('emp_id', $empId)->where('status', 0)->update($data);
        }else{
            return 'not work';
        }
    }
}
