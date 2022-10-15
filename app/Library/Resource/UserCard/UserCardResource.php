<?php

namespace BankI\Resource\UserCard;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCardResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cardNumber' => '**** **** **** ****',
            'expiry' => $this->expiry_month_and_year,
            'securityCode' => $this->cvc,
            'isDefault' => $this->is_default,
            'color' => $this->color,
            'status' => $this->status,
        ];
    }

}
