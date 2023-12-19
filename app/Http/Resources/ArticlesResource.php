<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
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
      'subcategory' => $this->subcategory->name,
      'subcategory_id' => $this->subcategory_id,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at,
    ];
  }
}
