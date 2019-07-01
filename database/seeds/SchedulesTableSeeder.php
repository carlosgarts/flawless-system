<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=SchedulesTableSeeder
     * @return void
     */
    public function run()
    {
      DB::table('schedules')->insert([
          'start_time' => '07:00:00',
          'finish_time' => '20:00:00'
      ]);
    }
}
