<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ordertrash extends Model
{
    public $timestamps = false;
      protected $table ='ordertrashs';

    protected $fillable = ['item_id','price','qty'];
}
