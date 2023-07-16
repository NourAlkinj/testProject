<?php

namespace App\Traits;

trait  UserTrait
{
    public function updateValueInDB( $model, $key, $value)
    {
        $model->$key = $value;
        $model->save();
    }



}
