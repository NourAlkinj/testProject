<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class CheckPhone implements Rule
{

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        $res = Http::get('https://phonevalidation.abstractapi.com/v1/?api_key=<YOUR_API_KEY>&phone_number=' . $value);
        // check if we got a good response code between 200 and 299
        if ($res->successful()) {
            $data = $res->json();
            if ($data['valid']) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function message()
    {
        return 'Abstract API Reported Invalid Phone Number Format';
    }
}
