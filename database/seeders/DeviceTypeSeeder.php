<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeviceType;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $reasons = [
            ['id' => '1','name' => 'Media Player'],
            ['id' => '2','name' => 'Screen'],
            ['id' => '3','name' => 'Network Device'],
            ['id' => '4','name' => 'Projector'],                        
            ['id' => '5','name' => 'Projector Lamp'],     
            ['id' => '6','name' => 'Others'],                       
        ];

        foreach($reasons as $reason) {
            DeviceType::create($reason);
            }   
    }
}
