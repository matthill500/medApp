<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Visit;
use App\Doctor;
use Auth;
use App\medInsurance;

class visitController extends Controller
{
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

      return view('doctor.visits.index')->with([
        'visits' => $visits,
        'doctors' => $doctors,
        'patients' => $patients
      ]);
    }

    public function create()
    {
      $patients = Patient::all();
      $doctors = Doctor::all();
      return view('doctor.visits.create')->with([
        'patients' => $patients,
        'doctors' => $doctors

      ]);
    }

    public function store(Request $request)
    {
      $request->validate([
      'date' => 'required',
      'time'  => 'required',
      'duration'  => 'required',
      'cost' => 'required',
      'patient_id'  => 'required',
      ]);

      $visit = new Visit();

      $visit->visitTime = $request->input('time');
      $visit->visitDate = $request->input('date');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = Auth::User()->doctor->id;
      $visit->patient_id = $request->input('patient_id');

      $visit->save();

      return redirect()->route('doctor.visits.index');
    }

    public function edit($id)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $visit = Visit::findOrFail($id);

        return view('doctor.visits.edit')->with([
          'patients' => $patients,
          'doctors' => $doctors,
          'visit' => $visit
        ]);
    }

    public function update(Request $request, $id)
    {
      $visit = Visit::findOrFail($id);

      $request->validate([
      'date' => 'required',
      'time'  => 'required',
      'duration'  => 'required',
      'cost' => 'required',
      'patient_id'  => 'required',
      ]);


      $visit->visitTime = $request->input('time');
      $visit->visitDate = $request->input('date');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->patient_id = $request->input('patient_id');

      $visit->save();

      return redirect()->route('doctor.visits.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $visit = Visit::findOrFail($id);

      $visit->delete();

      return redirect()->route('doctor.visits.index');
    }
}
