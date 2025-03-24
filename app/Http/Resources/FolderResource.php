<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'parent' => new FolderResource($this->whenLoaded('parent')),

            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'parent_id' => $this->parent_id,
            'children' => FolderResource::collection($this->whenLoaded('children')),
        ];
    }
}
