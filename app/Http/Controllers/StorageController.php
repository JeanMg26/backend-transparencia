<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storage\UploadImageRequest;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
  function uploadImage(UploadImageRequest $request)
  {
    $image_path = $request->file('path')->store('image', 'public');

    $storage = new Storage;
    $storage->path = $image_path;
    $storage->save();

    return response()->json(['id_image' => $storage->id]);
  }
}
