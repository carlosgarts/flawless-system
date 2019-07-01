<?php

namespace Flawless\Agenda\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule
 *
 * @package Agenda
 * @property time $start_time
 * @property time $finish_time
*/

class Schedule extends Model
{
  use SoftDeletes;

  protected $fillable = ['start_time', 'finish_time'];


  /**
   * Set attribute to date format
   * @param $input
   */
  public function setStartTimeAttribute($input)
  {
      if ($input != null && $input != '') {
          $this->attributes['start_time'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
      } else {
          $this->attributes['start_time'] = null;
      }
  }

  /**
   * Get attribute from date format
   * @param $input
   *
   * @return string
   */
  public function getStartTimeAttribute($input)
  {
      if ($input != null && $input != '') {
          return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
      } else {
          return '';
      }
  }

  /**
   * Set attribute to date format
   * @param $input
   */
  public function setFinishTimeAttribute($input)
  {
      if ($input != null && $input != '') {
          $this->attributes['finish_time'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
      } else {
          $this->attributes['finish_time'] = null;
      }
  }

  /**
   * Get attribute from date format
   * @param $input
   *
   * @return string
   */
  public function getFinishTimeAttribute($input)
  {
      if ($input != null && $input != '') {
          return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
      } else {
          return '';
      }
  }

}
