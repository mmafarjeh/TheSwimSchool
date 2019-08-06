<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * An Eloquent Model: 'Location'.
 *
 * @property int $id
 * @property string $name
 * @property string $street
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $pool_access_instructions
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 */
class Location extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'street', 'city', 'state', 'zip'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function Tryouts()
    {
        $this->hasMany(Tryout::class);
    }
}
