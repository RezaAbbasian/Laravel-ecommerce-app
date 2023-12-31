<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'authorization' => [
                'token' => $this->createToken('ApiToken')->plainTextToken,
                'type' => 'bearer',
            ],
            'success' => true,
            'message' => 'SUCCESS',
        ];
    }
}
