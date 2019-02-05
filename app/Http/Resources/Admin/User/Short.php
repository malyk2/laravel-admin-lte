<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Short extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->additional);
        return [
            'id' => $this->id,
            'email' => $this->email,
            //additional
            'tokens' => $this->when($tokens = array_get($this->additional, 'tokens'), $tokens),
        ];
    }
}
