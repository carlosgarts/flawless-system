<?php

namespace Flawless\Agenda\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Hollyday
 *
 * @package Agenda
 * @property string $name
 * @property date $day
*/


class Hollyday extends Model
{

  use SoftDeletes;

  protected $fillable = ['name', 'day'];


  /**
   * Set attribute to date format
   * @param $input
   */
  public function setDayAttribute($input)
  {
      if ($input != null && $input != '') {
          $this->attributes['day'] = Carbon::createFromFormat('Y-m-d', $input)->format('Y-m-d');
      } else {
          $this->attributes['day'] = null;
      }
  }

  /**
   * Get attribute from date format
   * @param $input
   *
   * @return string
   */
  public function getDayAttribute($input)
  {
      if ($input != null && $input != '') {
          return Carbon::createFromFormat('Y-m-d', $input)->format('Y-m-d');
      } else {
          return '';
      }
  }

}
