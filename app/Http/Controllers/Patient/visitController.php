<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Visit;
use App\Doctor;
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

      return view('patient.visits.index')->with([
        'visits' => $visits,
        'doctors' => $doctors,
        'patients' => $patients
      ]);
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

      return redirect()->route('patient.visits.index');
    }
}
