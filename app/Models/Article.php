<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'description', 'autor', 'subcategory_id'];

  public function subcategory()
  {
    return $this->belongsTo(Subcategory::class);
  }
}
