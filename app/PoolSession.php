<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoolSession extends Model
{
    public function model()
    {
        return $this->morphTo();
    }
}
