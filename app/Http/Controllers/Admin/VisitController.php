<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Visit;
use App\Patient;
use App\Doctor;
class VisitController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $visits = Visit::all();
      $doctors = Doctor::all();
      $patients = Patient::all();

      return view('admin.visits.index')->with([
        'visits' => $visits,
        'doctors' => $doctors,
        'patients' => $patients
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $patients = Patient::all();
      $doctors = Doctor::all();
      return view('admin.visits.create')->with([
        'patients' => $patients,
        'doctors' => $doctors

      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
      'date' => 'required',
      'time'  => 'required',
      'duration'  => 'required',
      'cost' => 'required',
      'doctor_id'  => 'required',
      'patient_id'  => 'required',
      ]);

      $visit = new Visit();

      $visit->visitTime = $request->input('time');
      $visit->visitDate = $request->input('date');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = $request->input('doctor_id');
      $visit->patient_id = $request->input('patient_id');

      $visit->save();

      $request->session()->flash('success', 'Visit added successfully');

      return redirect()->route('admin.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $vId = (int)$id;
      $visit = Visit::findOrFail($vId);

      return view('admin.visits.show')->with([
        'visit' => $visit,
        'id' => $vId
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $visit = Visit::findOrFail($id);

        return view('admin.visits.edit')->with([
          'patients' => $patients,
          'doctors' => $doctors,
          'visit' => $visit
        ]);
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
      $visit = Visit::findOrFail($id);

      $request->validate([
      'date' => 'required',
      'time'  => 'required',
      'duration'  => 'required',
      'cost' => 'required',
      'doctor_id'  => 'required',
      'patient_id'  => 'required',
      ]);


      $visit->visitTime = $request->input('time');
      $visit->visitDate = $request->input('date');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = $request->input('doctor_id');
      $visit->patient_id = $request->input('patient_id');

      $visit->save();

      $request->session()->flash('info', 'Visit updated successfully');

      return redirect()->route('admin.visits.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $visit = Visit::findOrFail($id);

      $visit->delete();

      $request->session()->flash('danger', 'Visit deleted successfully');

      return redirect()->route('admin.visits.index');
    }
}
