<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SolutionType;

class SolutionTypeSeeder extends Seeder
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
            ['id' => '1','name' => 'Single Screen'],
            ['id' => '2','name' => 'Dual Screen'],
            ['id' => '3','name' => '3 x 1'],
            ['id' => '4','name' => '4 x 1'],                        
            ['id' => '5','name' => '5 x 1'],     
            ['id' => '6','name' => 'Map Table'],     
            ['id' => '7','name' => 'MRH Kiosk'],  
            ['id' => '8','name' => 'Video Wall/LED Wall'],          
            ['id' => '9','name' => 'B2B'],                                                           
        ];

        foreach($reasons as $reason) {
            SolutionType::create($reason);
            }    
    }
}
