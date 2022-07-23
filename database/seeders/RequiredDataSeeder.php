<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CModel;
use App\Models\Employee;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequiredDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedDefaultAdminAccount();
        $this->seedDefaultCarsAndModels();
        $this->seedDefaultStates();
    }

    /**
     * Creates the default administrator account.
     *
     * @return void
     */
    protected function seedDefaultAdminAccount()
    {
        User::factory(5)->create();
    }

    /**
     * Creates the default cars.
     *
     * @return void
     */
    protected function seedDefaultCarsAndModels()
    {
//        $getCars = file_get_contents(base_path('resources/data/php-mastercars.json'));
//        $cars = json_decode($getCars, true);
//
//        $values = array_column($cars,'value');
//        $titles = array_column($cars,'title');
//
//        $data = [];
//        for($i=0; $i<count($values); $i++){
//            $data[$i] = [
//                'value' => $values[$i],
//                'title' => $titles[$i],
//            ];
//        }
//        Car::insert($data);
        $getCars = file_get_contents(base_path('resources/data/php-mastercars.json'));
        $cars = json_decode($getCars, true);

        foreach($cars as $car) {
            $car_id = Car::create([
                'value' => $car['value'],
                'title' => $car['title'],
            ])->id;
            foreach($car['models'] as $model) {
                CModel::insert([
                    'value' => $model['value'],
                    'title' => $model['title'],
                    'car_id' => $car_id,
                ]);
            }

        }
    }

    /**
     * Creates the default car models.
     *
     * @return void
     */
    protected function seedDefaultStates()
    {
        $getStates = file_get_contents(base_path('resources/data/php-masterstates.json'));
        $states = json_decode($getStates, true);

        State::insert($states);
    }


}
