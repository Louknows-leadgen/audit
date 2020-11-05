<?php

use Illuminate\Database\Seeder;
use App\Models\AgentCorrection;

class AgentCorrectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $agent_corrections = [
        	'No intro',
        	'Delayed intro',
        	'Did not proceed to z02',
        	'No acknowledgement',
        	'No rebuttal',
        	'Incorrect tagging',
        	'Interrupting prospect',
        	'Inappropriate response',
        	'Call avoidance',
        	'Stayed on the line for too long',
        	'Did not obtained/Incorrect detail',
            'Delayed response'
        ];

        foreach ($agent_corrections as $agent_correction) {
        	$ac = new AgentCorrection;
        	$ac->name = $agent_correction;
        	$ac->save();
        }
    }
}
