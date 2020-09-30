<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
  public $timestamps = false;
  protected $fillable = ['category_id','artitle','entitle'];

}
