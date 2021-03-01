<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReplacementReason;

class ReplacementReasonSeeder extends Seeder
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
            ['id' => '1','name' => 'Corrupted Operating System'],
            ['id' => '2','name' => 'Operating System keeps locking up/Operating System Frozen'],
            ['id' => '3','name' => 'Media player has no Power '],
            ['id' => '4','name' => 'Media Player does not POST'],                        
            ['id' => '5','name' => 'Faulty CMOS/BIOS'],     
            ['id' => '6','name' => 'Faulty Videocard'],      
            ['id' => '7','name' => 'Faulty Hardware'],                    
        ];

        foreach($reasons as $reason) {
            ReplacementReason::create($reason);
            }   
    }
}
