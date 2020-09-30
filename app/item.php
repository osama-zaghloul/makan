<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
  public $timestamps = false;
  protected $fillable = ['category','trader_id','title','price','desc','image','qty','productnum','size','color'];

}
