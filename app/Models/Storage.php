<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
  use HasFactory;

  protected $fillable = ['path'];

  public function activity()
  {
    return $this->hasOne(Activity::class);
  }
}
