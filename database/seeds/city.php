<?php

use Illuminate\Database\Seeder;

class city extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\City::class,10)->create();
    }
}
