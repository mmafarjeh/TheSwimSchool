<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * An Eloquent Model: 'PoolSession'
 *
 * @property integer $id
 * @property string $model_type
 * @property integer $model_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 */

class PoolSession extends Model
{
    use SoftDeletes;

    public function model()
    {
        return $this->morphTo();
    }
}
