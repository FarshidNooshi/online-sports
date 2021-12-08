<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Italy
        Country::factory(1)
            ->create([
                'country_id' => '8',
                'country_name' => 'Italy',
                'country_logo' => ''
            ]);
        // Spain
        Country::factory(1)
            ->create([
                'country_id' => '8',
                'country_name' => 'Spain'
            ]);
        // England
        Country::factory(1)
            ->create([
                'country_id' => '44',
                'country_name' => 'England'
            ]);
        // France
        Country::factory(1)
            ->create([
                'country_id' => '8',
                'country_name' => 'France',
            ]);
        // Germany
        Country::factory(1)
            ->create([
                'country_id' => '8',
                'country_name' => 'Germany',
            ]);
        // Iran
        Country::factory(1)
            ->create([
                'country_id' => '8',
                'country_name' => 'Iran',
            ]);
        // Euro
        Country::factory(1)
            ->create([
                'country_id' => '1',
                'country_name' => 'Eurocups'
            ]);
        // World
        Country::factory(1)
            ->create([
                'country_id' => '8',
                'country_name' => 'Worldcup'
            ]);
    }
}
