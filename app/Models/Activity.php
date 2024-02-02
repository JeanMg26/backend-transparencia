<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'description', 'autor', 'storage_id'];

  public function storage()
  {
    return $this->belongsTo(Storage::class);
  }
}
