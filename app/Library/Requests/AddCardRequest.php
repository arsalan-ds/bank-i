<?php

namespace BankI\Requests;

use BankI\Abstracts\FormRequest;

class AddCardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cardNumber' => 'required|int|min:16',
            'expiry' => 'required',
            'securityCode' => 'required',
            'isDefault' => 'required',
        ];
    }

    public function prepareRequest($userId){
        $request = $this;
        return [
            'userId' => $userId,
            'cardNumber' => $request['cardNumber'],
            'expiry' => $request['expiry'],
            'securityCode' => $request['securityCode'],
            'isDefault' => $request['isDefault'],
            'color' => '#'.$this->random_color()
        ];
    }

    public function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    public function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
