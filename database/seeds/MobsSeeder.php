<?php

use App\Models\Mob;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mob::insert([
            [
                'name' => 'Bowser',
                'image' => '/assets/mobs/Bowser.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cthulhu',
                'image' => '/assets/mobs/Cthulhu.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dr Robotnik',
                'image' => '/assets/mobs/DrRobotnik.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
