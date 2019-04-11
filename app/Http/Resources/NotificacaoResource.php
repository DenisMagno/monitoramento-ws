<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'icon' => $this->icon,
            'sound' => $this->sound,
            'color' => $this->color,
            'clickAction' => $this->clickAction,
            'tag' => $this->tag,
            'link' => $this->link
        ];
    }
}