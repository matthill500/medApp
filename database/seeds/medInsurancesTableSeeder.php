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

      $medInsurance = new MedInsurance();
      $medInsurance->companyName = 'quoteDevil';
      $medInsurance->policyNum = 'abc456';
      $medInsurance->save();

      $medInsurance = new MedInsurance();
      $medInsurance->companyName = 'goCompare';
      $medInsurance->policyNum = '1738kj';
      $medInsurance->save();
    }
}
