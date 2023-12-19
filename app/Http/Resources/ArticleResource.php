<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'autor' => $this->autor,
      'description' => $this->description,
      'category' => $this->subcategory->category->name,
      'category_id' => $this->subcategory->category->id,
      'subcategory_id' => $this->subcategory_id,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at,
    ];
  }
}
