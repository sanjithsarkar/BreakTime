<?php

namespace App\Http\Controllers;

use App\Models\BreakTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

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
        $validatedData = Validator::make($request->all(), [
            'emp_id' => 'required|numeric|max:255',
            'break_type' => 'required|string|max:255',
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }

        $date = Carbon::now();
        $formattedDate = $date->format('d-m-Y H:i:s');

        $isExit = BreakTime::where('emp_id', $request->emp_id)->where('status', 0)->first();

        if (!$isExit) {
            $breakTime = BreakTime::create([
                'emp_id' => $request->emp_id,
                'break_type' => $request->break_type,
                'break_in' => $formattedDate,
                'status' => 0,
            ]);

            // if (Inertia::get()->wantsJson()) {
            //     return response()->json(['data' => $breakTime]);
            // }

            session()->flash('message', 'The break has started!!');

        } else {

            // ---------------- json call in inertia ----------------
            // if ($request->wantsJson()) {
            //     return response()->json(['error' => 'There is already a running break!!']);
            // }

            // session()->flash('message', 'There is already a running break!!');

            // return redirect()->back()->withErrors(['error' => 'There is already a running break!!']);


            // -------------- without json call session flash ----------------------

            session()->flash('message', 'There is already a running break!!');

            return redirect()->back();
        }
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

    public function updateBreak(Request $request)
    {

        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'emp_id' => 'required|numeric|max:255',
            // 'break_type' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $date = Carbon::now();
        $formattedDate = $date->format('d-m-Y H:i:s');
        $empId = $request->emp_id;

        $isExit = BreakTime::where('emp_id', $empId)->where('status', 0)->first();

        if ($isExit) {
            $data = array();
            $data['break_end'] = $formattedDate;
            $data['status'] = 1;
            DB::table('break_times')->where('emp_id', $empId)->where('status', 0)->update($data);

            session()->flash('message', 'Break End Successfully End!!');
        } else {
            session()->flash('message', 'There is no available break!!');
        }

        if ($empId) {
            $breakTime = BreakTime::where('emp_id', $empId)->where('total', null)->first();
            $carbon1 = Carbon::parse($breakTime->break_in);
            $carbon2 = Carbon::parse($breakTime->break_end);
            $diff = $carbon2->diff($carbon1);

            $hours = $diff->h;
            $minutes = $diff->i;
            $seconds = $diff->s;

            // Format the time difference
            $formattedTime = sprintf("%02d-%02d-%02d", $hours, $minutes, $seconds);

            // dd($formattedTime);

            $data = array();
            $data['total'] = $formattedTime;
            DB::table('break_times')->where('emp_id', $empId)->where('total', Null)->update($data);
        }
    }


    public function breakEmployee(Request $request)
    {
        return Inertia::render('Break/View');
    }
}
