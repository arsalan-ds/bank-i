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
        ];
    }

    public function prepareRequest($userId){
        $request = $this;
        return [
            'userId' => $userId,
            'cardNumber' => $request['cardNumber'],
            'expiry' => $request['expiry'],
            'securityCode' => $request['securityCode'],
            'color' => $this->colors()
        ];
    }

    public function colors(){
        $array = [
            '#008080', '#977878', '#201818', '#201820', '#906f90', '#462046'
        ];
        // return array_rand($array, 1);
        // shuffle($array);
        return $array[2];
    }
}
