<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Role;
use DB;
class PatientController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

    $patients = DB::table('patients')
    ->leftJoin('users','users.id', '=', 'patients.user_id')
    ->get();

    return view('admin.patients.index')->with([
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
    return view('admin.patients.create');
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
    'name' => 'required|',
    'email'  => 'required|email|unique:users,email',
    'password'  => 'required|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
    'phone'  => 'required|max:14',
    'address'  => 'required|max:30',
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));

    $user->save();

    $patient = new Patient();

    $patient->phone = $request->input('phone');
    $patient->address = $request->input('address');

    $patient->user_id = $user->id;

    $patient->save();

    $user->roles()->attach(Role::where('name','patient')->first());



    return redirect()->route('admin.patients.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
  $patients = DB::table('patients')
  ->leftJoin('users','users.id', '=', 'patients.user_id')
  ->where('user_id', '=', $id)
  ->first();


    return view('admin.patients.show')->with([
      'patients' => $patients
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
  $patients = DB::table('patients')
  ->leftJoin('users','users.id', '=', 'patients.user_id')
  ->where('user_id', '=', $id)
  ->first();


    return view('admin.patients.edit')->with([
      'patients' => $patients
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
  $user = User::findOrFail($id);

  $request->validate([
  'name' => 'required|',
  'email'  => 'required|email',
  'phone'  => 'required|max:14',
  'address'  => 'required|max:30',
  ]);


  $user->name = $request->input('name');
  $user->email = $request->input('email');
  $user->patient->phone = $request->input('phone');
  $user->patient->address = $request->input('address');

  $user->save();
  $user->patient->save();

  return redirect()->route('admin.patients.index');

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {

  $user = User::findOrFail($id);

  $user->roles()->detach();

  $user->delete();

  return redirect()->route('admin.patients.index');
  }
}