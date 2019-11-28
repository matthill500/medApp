<?php

use Illuminate\Database\Seeder;
use App\medInsurance;
class medInsurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $medInsurance = new MedInsurance();
      $medInsurance->companyName = '123.ie';
      $medInsurance->policyNum = '137phy';
      $medInsurance->save();
    }
}
