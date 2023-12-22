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
      'route' => $this->route,
      'category' => $this->category->name,
      'category_id' => $this->category->id,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at,
    ];
  }
}
