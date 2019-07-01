<?php

namespace Flawless\Agenda\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
  use SoftDeletes;

  protected $fillable = ['name', 'description', 'image'];

  public function services()
    {
        return $this->belongsToMany('Flawless\Agenda\Models\Service');
    }
}
