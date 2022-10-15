<?php

namespace BankI\Utils;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class HttpRequest
{
    public static function sendRequest($url,$data=null, $isPost=false, $header=[]){
        if($isPost){
            $response = Http::withHeaders($header)->post($url,$data);
        }else{
            $response = Http::withHeaders($header)->get($url);
        }
        if($response->status() == Response::HTTP_OK){
            return json_decode($response->body());
        }
        return false;
    }
}
