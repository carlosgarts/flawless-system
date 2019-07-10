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

    public function appointments()
      {
          return $this->belongsToMany('Flawless\Agenda\Models\Appointment');
      }
}
