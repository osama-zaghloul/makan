<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class subscriped_email extends Model
{
  public $timestamps = false;
  protected $table ='subscribed_emails';
  protected $fillable = ['email','created_at'];
}
