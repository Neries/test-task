<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use  Illuminate\Database\Eloquent\Collection as Collection;


class EmployeesTableSeader extends Seeder
{
    private $numberOfEmployees = 500;
    private $depth = 5;
    private $ids = [];
    private $suitableIds = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO: count of directors
        $faker = Faker::create('ru_RU');

        $allGeneratedData = new Collection();

        for ($i = 0; $i < $this->numberOfEmployees; $i++) {
            $gender = $faker->randomElements(['male', 'female'])[0];
            $newItem = \App\Employee::create([
                'last_name' => $gender === 'male' ? $faker->lastName : $faker->lastName . 'a',
                'first_name' => $faker->firstName($gender),
                'patronymic' => $faker->middleName($gender),
                'position' => $faker->jobTitle,
                'employment_date' => $faker->date('Y-m-d H:i:s'),
                'salary' => $faker->randomFloat(2, 500, 15000),
                'chief_id' => $allGeneratedData->count() ? array_random($this->suitableIds) : 0,
            ]);
            $allGeneratedData->push($newItem);
            $this->setSuitableIds($allGeneratedData);
        }
    }

    /**
     * Adds identifiers in suitableIds.
     *
     * @param Collection $allGeneratedData
     *
     * @return void
     */
    private function setSuitableIds(Collection $allGeneratedData)
    {

        $this->ids = $allGeneratedData->mapWithKeys(function ($item) {
            return [$item['id'] => $item['chief_id']];
        })->toArray();

        $lastRecord = $allGeneratedData->last();

        $countHierarchies = $this->countDepth($lastRecord->id);
        var_dump($countHierarchies);
        if ($countHierarchies < $this->depth - 2) {
            $this->suitableIds[] = $lastRecord->id;
        }
    }

    /**
     * Count and return the number of parents.
     *
     * @param $id
     * @param int $countHierarchies
     * @return int
     */
    private function countDepth($id, $countHierarchies = 0)
    {
        $chiefId = $this->ids[$id];

        if (!empty($this->ids[$chiefId])) {
            $countHierarchies++;
            $countHierarchies = $this->countDepth($chiefId, $countHierarchies);
        }
        return $countHierarchies;
    }
}