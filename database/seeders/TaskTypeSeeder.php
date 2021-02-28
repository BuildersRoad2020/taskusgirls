<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskType;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tasktypes = [
            ['id' => '1','name' => 'Hardware Replacement'],
            ['id' => '2','name' => 'Technician Request'],
            ['id' => '3','name' => 'Faulty Unit Return'],
            ['id' => '4','name' => 'Warranty Repair'],                        
            ['id' => '5','name' => 'Invoice Request']             
        ];

        foreach($tasktypes as $task) {
            TaskType::create($task);
            }   
    }
}
