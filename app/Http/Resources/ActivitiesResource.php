<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivitiesResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    // return parent::toArray($request);
    return [
      'id' => $this->id,
      'title' => $this->title,
      'autor' => $this->autor,
      'image' => asset('storage/' . $this->storage->path),
      // 'image' => $this->storage,
      'description' => $this->description,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at,
    ];
  }
}
