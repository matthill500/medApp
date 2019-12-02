<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctor;
use App\User;
use App\Role;
use DB;

class DoctorController extends Controller
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

        $doctors = DB::table('doctors')
        ->leftJoin('users','users.id', '=', 'doctors.user_id')
        ->get();

        return view('admin.doctors.index')->with([
         'doctors' => $doctors
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctors.create');
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
        'eircode'  => 'required|max:7',
        'dateStart'  => 'required',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        $doctor = new Doctor();

        $doctor->phone = $request->input('phone');
        $doctor->eircode = $request->input('eircode');
        $doctor->dateStart = $request->input('dateStart');
        $doctor->user_id = $user->id;

        $doctor->save();

        $user->roles()->attach(Role::where('name','doctor')->first());

        $request->session()->flash('success', 'Doctor added successfully');

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $doctors = DB::table('doctors')
      ->leftJoin('users','users.id', '=', 'doctors.user_id')
      ->where('user_id', '=', $id)
      ->first();


        return view('admin.doctors.show')->with([
          'doctors' => $doctors
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
      $doctors = DB::table('doctors')
      ->leftJoin('users','users.id', '=', 'doctors.user_id')
      ->where('user_id', '=', $id)
      ->first();


        return view('admin.doctors.edit')->with([
          'doctors' => $doctors
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
      'eircode'  => 'required|max:7',
      'dateStart'  => 'required',
      ]);


      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->doctor->phone = $request->input('phone');
      $user->doctor->eircode = $request->input('eircode');
      $user->doctor->dateStart = $request->input('dateStart');
      $user->save();
      $user->doctor->save();


      $request->session()->flash('info', 'Doctor updated successfully');

      return redirect()->route('admin.doctors.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

      $user = User::findOrFail($id);

      $user->roles()->detach();

      $user->delete();

      $request->session()->flash('danger', 'Doctor deleted successfully');

    return redirect()->route('admin.doctors.index');





    }
}
