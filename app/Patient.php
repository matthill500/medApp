<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
  protected $fillable = [
      'phone', 'address', 'medInsurance_id',
  ];
  public function user(){
    return $this->belongsTo('App\user');
  }
  public function medInsurance(){
    return $this->belongsTo('App\medInsurance', 'medInsurance_id');
  }
}
