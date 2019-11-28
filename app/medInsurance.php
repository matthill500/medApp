<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medInsurance extends Model
{
  public function patients(){
    return $this->hasMany('App\Patient', 'patients');
  }
}
