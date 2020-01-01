<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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
            'id' => $this->id, //QUESTION: Isto 'e para ser enviado?
            'email' => $this->email,
            'balance' => $this->balance ,
            // 'created_at'=> $this->created_at DEV_ONLY
         ];
    }
}
