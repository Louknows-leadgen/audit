<?php

use Illuminate\Database\Seeder;
use App\Models\Campaign;

class CampaignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $campaigns = [
        	['code' => 1, 'name' => '3000', 'short_desc' => 'Insurance Campaign']
        ];

        foreach ($campaigns as $campaign) {
        	$c = new Campaign;
        	$c->code = $campaign['code'];
        	$c->name = $campaign['name'];
        	$c->short_desc = $campaign['short_desc'];
        	$c->save();
        }
    }
}
