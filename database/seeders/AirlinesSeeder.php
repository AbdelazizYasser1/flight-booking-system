<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;

class AirlinesSeeder extends Seeder
{
    public function run()
    {
        $airlines = [
            [
                'code' => 'EGY',
                'name' => 'EgyptAir',
                'logo' => 'airlines/logo-egypt.png', 
            ],
            [
                'code' => 'QTR',
                'name' => 'Qatar Airways',
                'logo' => 'airlines/logo-qatar.png', 
            ],
            [
                'code' => 'EMR',
                'name' => 'Emirates',
                'logo' => 'airlines/logo-emarate.png', 
            ],
            [
                'code' => 'SLX',
                'name' => 'Starlux Airlines',
                'logo' => 'airlines/logo-starlux.png', 
            ],
            [
                'code' => 'AAL',
                'name' => 'American Airlines',
                'logo' => 'airlines/logo-american.png', 
            ],
            [
                'code' => 'SWR',
                'name' => 'Swiss International Air Lines',
                'logo' => 'airlines/logo-swiss.png',
            ],
            [
                'code' => 'LOT',
                'name' => 'LOT Polish Airlines',
                'logo' => 'airlines/logo-polanda.png', 
            ],    
            [
                'code' => 'ITA',
                'name' => 'ITA Airways',
                'logo' => 'airlines/logo-italia.png', 
            ],
            [
                'code' => 'CTN',
                'name' => 'Croatia Airlines',
                'logo' => 'airlines/logo-croata.png', 
            ],
            [
                'code' => 'UNK',
                'name' => 'Unknown Airline',
                'logo' => 'airlines/default.png',
            ],            
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }
    }
}
