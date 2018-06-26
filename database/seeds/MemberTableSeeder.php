<?php

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Member::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Member::create([
                'name' => $faker->name,
                'avatar' => $faker->imageUrl(100,100),
                'email' => $faker->email,
                'tel' => $faker->phoneNumber,
                'visitor' => $faker->city,
                'state' => 1,
                'password'=>bcrypt('xtn123')
            ]);
        }
    }
}
