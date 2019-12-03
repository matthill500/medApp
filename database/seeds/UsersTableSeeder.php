<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Patient;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      factory(App\User::class,10)->create();

      App\User::all()->each(function ($user){
      $user->roles()->attach(rand(1, Role::count()));
    });
        $role_admin = Role::where('name', 'admin')->first();
        $role_doctor = Role::where('name', 'doctor')->first();
        $role_patient = Role::where('name', 'patient')->first();

        $admin = new User();
        $admin->name = 'Matt Hill';
        $admin->email = 'admin@medapp.ie';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

         $doctor = new User();
         $doctor->name = 'John Jones';
         $doctor->email = 'johnj@medapp.ie';
         $doctor->password = bcrypt('secret');
         $doctor->save();
         $doctor->roles()->attach($role_doctor);

         $patient = new User();
         $patient->name = 'Jenny';
         $patient->email = 'jenny@medapp.ie';
         $patient->password = bcrypt('secret');
         $patient->save();
         $patient->roles()->attach($role_patient);

         $doctor = new User();
         $doctor->name = 'Ben';
         $doctor->email = 'ben@medapp.ie';
         $doctor->password = bcrypt('secret');
         $doctor->save();
         $doctor->roles()->attach($role_doctor);

    }
}
