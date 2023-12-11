<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCatRequest;
use App\Http\Requests\Category\UpdateCatRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  // ------ Created Cat ------
  public function createCat(CreateCatRequest $request)
  {
    Category::create([
      'name' => $request->name
    ]);

    return response()->json(["message" => "Cat add successfully"]);
  }

  // ------ List Cats ------
  public function listCat()
  {
    $cats = Category::all();

    return response()->json(["items" => $cats]);
  }

  // ------ Get Cat ------
  public function getCat($id)
  {
    $cat = Category::find($id);

    if (is_null($cat)) {
      return response()->json(['message' => 'Cat not found.'], 404);
    }

    return response()->json(["item" => $cat]);
  }

  // ------ Update Cat ------
  public function updateCat(UpdateCatRequest $request, $id)
  {
    $cat = Category::find($id);

    if (is_null($cat)) {
      return response()->json(['message' => 'Cat not found.'], 404);
    }

    $cat->update([
      'name' => $request->name
    ]);

    return response()->json(['message' => 'Cat updated successfully.'], 200);
  }

  // ------ Delete Cat ------
  public function deleteCat($id)
  {
    $cat = Category::find($id);

    if (is_null($cat)) {
      return response()->json(['message' => 'Cat not found.'], 404);
    }

    $cat->delete();

    return response()->json(['message' => 'Cat delete successfully.'], 200);
  }
}
