<?php

namespace App;

use App\Library\Interfaces\CalendarInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 *
 * An Eloquent Model: 'Tryout'
 *
 * A tryout is to see if you are skilled enough for the swim team
 *
 * @property integer $id
 * @property integer $season_id
 * @property integer $location_id
 * @property integer $class_size
 * @property \Illuminate\Support\Carbon $registration_open
 * @property \Illuminate\Support\Carbon $event_time
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property-read \App\Group $group
 * @property-read \App\Location $location
 * @property-read \App\Season $season
 */

class Tryout extends Model implements CalendarInterface
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at', 'registration_open', 'event_time'];

    /**
     * @var array
     */
    protected $fillable = [
        'location_id',
        's_t_season_id',
        'class_size',
        'registration_open',
        'event_time'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Athletes()
    {
        return $this->hasMany(Athlete::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }

    public function Season()
    {
        return $this->belongsTo(STSeason::class, 's_t_season_id');
    }


    /**
     * @return mixed
     */
    public function AllTryoutsOpenForSignups()
    {
        return $this->whereDate('class_start_date', '>', Carbon::now())
                    ->whereDate('registration_open', '<=', Carbon::now());
    }


    /**
     * @return bool
     */
    public function isFull()
    {
        if($this->athletes()->count() >= $this->getAttribute('class_size')){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCurrentSeason($query)
    {
        return $query->where('s_t_season_id', STSeason::GetCurrentSeason()->id);
    }

    public function PoolSessions()
    {
        return $this->morphMany('App\PoolSession', 'model');
    }

    public function path()
    {
        return '/swim-team/tryouts/' . $this->id;
    }

    public function title()
    {
        return 'North River Swim Team Tryout';
    }
}
