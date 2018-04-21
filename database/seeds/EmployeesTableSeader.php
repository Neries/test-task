<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use  Illuminate\Database\Eloquent\Collection as Collection;

class EmployeesTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('ru_RU');

        $allGeneratedData = new Collection();

        for ($i = 0; $i < 3; $i++) {
            $gender = $faker->randomElements(['male', 'female'])[0];
            $newItem = \App\Employee::create([
                'last_name' => $gender === 'male' ? $faker->lastName : $faker->lastName.'a',
                'first_name' => $faker->firstName($gender),
                'patronymic' =>  $faker->middleName($gender),
                'position' => $faker->jobTitle,
                'employment_date' => $faker->date('Y-m-d H:i:s'),
                'salary' => $faker->randomFloat(2,500,15000 ),
                'chief_id' => $allGeneratedData->count() ? $allGeneratedData->random()->id : 0,
            ]);
//            $allGeneratedData->push($newItem);

        }

    }

    private function getRandomChief(Collection $allGeneratedData, $depth = 4)
    {
        $chief = $allGeneratedData->random();
        $counter = 1;
        while ($chief->chief_id !== 0) {
            $chief = $allGeneratedData->where('id', '=', $chief->chief_id);
            $counter++;
        }

    }
}
