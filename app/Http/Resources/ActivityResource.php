<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
      'url_img' => asset('storage/' . $this->storage->path),
      'id_img' =>  $this->storage->id,
      'description' => $this->description,
      "created_at" => $this->created_at,
      "updated_at" => $this->updated_at,
    ];
  }
}
