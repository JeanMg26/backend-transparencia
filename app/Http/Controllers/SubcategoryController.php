<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subcategory\CreateSubcategoryRequest;
use App\Http\Requests\Subcategory\UpdateSubcategoryRequest;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
  // ------ Created Subcat ------
  public function createSubcat(CreateSubcategoryRequest $request)
  {
    Subcategory::create([
      'name' => $request->name,
      'category_id' => $request->category_id
    ]);

    return response()->json(["message" => "Subcat add successfully"]);
  }

  // ------ List Subcats ------
  public function listSubcat()
  {
    $subcats = Subcategory::all();

    return response()->json(["data" => $subcats]);
  }

  // ------ Get Subcat ------
  public function getSubcat($id)
  {
    $subcat = Subcategory::find($id);

    if (is_null($subcat)) {
      return response()->json(['message' => 'Subcat not found.'], 404);
    }

    return response()->json(["data" => $subcat]);
  }

  // ------ Update Subcat ------
  public function updateSubcat(UpdateSubcategoryRequest $request, $id)
  {
    $subcat = Subcategory::find($id);

    if (is_null($subcat)) {
      return response()->json(['message' => 'Subcat not found.'], 404);
    }

    $subcat->update([
      'name' => $request->name,
      'category_id' => $request->category_id
    ]);

    return response()->json(['message' => 'Sucat updated successfully.'], 200);
  }

  // ------ Delete Cat ------
  public function deleteSubcat($id)
  {
    $subcat = Subcategory::find($id);

    if (is_null($subcat)) {
      return response()->json(['message' => 'Subcat not found.'], 404);
    }

    $subcat->delete();

    return response()->json(['message' => 'Subcat delete successfully.'], 200);
  }
}
