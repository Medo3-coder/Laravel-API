<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [                  // this for make transform to the data
             // mame  of colmn => key 
            'id' => $this->id,
            'key' => $this->title,
            'content' => str_limit($this->body, 17)
        ];
    }
}
