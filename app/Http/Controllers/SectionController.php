<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionController extends Controller
{
  public function createSection()
  {
    return response()->json(['hello world']);
  }
}
