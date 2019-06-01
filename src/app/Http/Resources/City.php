<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class City extends JsonResource
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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'state' => State::make($this->resource->state),
            'country' => Country::make($this->resource->state->country),
            'full_name' => $this->resource->name . ' - ' . $this->resource->state->name . ' - ' . $this->resource->state->country->name
        ];
    }
}
