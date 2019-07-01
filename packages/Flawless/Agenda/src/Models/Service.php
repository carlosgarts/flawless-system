<?php

namespace Flawless\Agenda\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name', 'group_id', 'price', 'duration', 'available','description', 'image'];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDurationTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['duration'] = Carbon::createFromFormat('H:i', $input)->format('H:i');
        } else {
            $this->attributes['duration'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDurationTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i', $input)->format('H:i');
        } else {
            return '';
        }
    }

    public function appointments()
      {
          return $this->belongsToMany('Flawless\Agenda\Models\Appointment');
      }
}
