<?php

use Illuminate\Database\Seeder;

class EventDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EventDate::class, 8)->create();
    }
}
