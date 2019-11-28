<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedInsuranceIdToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
          $table->dropColumn('medInsurance');
          $table->bigInteger('medInsurance_id')->unsigned();
          $table->foreign('medInsurance_id')->references('id')->on('med_insurances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
          $table->dropForeign(['medInsurance_id']);
          $table->dropColumn('medInsurance_id');
          $table->string('medInsurance');
        });
    }
}
