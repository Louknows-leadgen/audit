<?php

use Illuminate\Database\Seeder;
use App\Models\ExternalFactor;

class ExternalFactorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $external_factors = [
        	'Line issue',
        	'VICI issue',
        	'Webform issue',
        	'Script issue',
        	'Time synch error'
        ];

        foreach ($external_factors as $external_factor) {
        	$ef = new ExternalFactor;
        	$ef->name = $external_factor;
        	$ef->save();
        }
    }
}
