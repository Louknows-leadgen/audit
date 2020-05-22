<?php

use Illuminate\Database\Seeder;
use App\Models\GeneralObservation;

class GeneralObservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $observations = [
        	['code' => 1, 'name' => 'Call OK'],
        	['code' => 2, 'name' => 'Incorrect Tagging'],
        	['code' => 3, 'name' => 'Non-Conformance'],
        	['code' => 4, 'name' => 'Agent did not clearly obtain the insurance provider'],
        	['code' => 5, 'name' => 'Did not obtain proper information'],
        	['code' => 6, 'name' => 'Did not obtain proper information- Agent did not clearly obtain name and proceeded to the next question'],
        	['code' => 7, 'name' => 'Did not obtain proper information- Agent did not clearly obtain the insurance provider and proceeded to the next question'],
        	['code' => 8, 'name' => 'Did not obtain proper information- Agent did not clearly obtain zipcode and proceeded to the next question'],
        	['code' => 9, 'name' => 'DNC request not honored'],
        	['code' => 10, 'name' => 'Failed Forced Transfer- Prospect busy/driving however agent pushed through with transfer'],
        	['code' => 11, 'name' => 'Forced Transfer- Prospect asked to be called back however agent pushed through with transfer'],
        	['code' => 12, 'name' => 'Forced Transfer- Prospect was not interested and agent pushed through with transfer'],
        	['code' => 13, 'name' => 'Forced Transfer- Prospect clearly stated he was not interested and was transferred'],
        	['code' => 14, 'name' => 'Inappropriate Response- Misleading information'],
        	['code' => 15, 'name' => 'Inappropriate Response- Rebuttals'],
        	['code' => 16, 'name' => 'Inappropriate Response- Responses to prospect questions'],
        	['code' => 17, 'name' => 'Language Barrier- prospect can answer but can barely be understood and can barely speak english'],
        	['code' => 18, 'name' => 'No positive response- Agent did not obtain a positive response before the transfer question'],
        	['code' => 19, 'name' => 'Not Qualified- Prospect was not qualified yet was still transferred'],
        	['code' => 20, 'name' => 'Prank- Prospect was not serious/prank yet was still transferred'],
        	['code' => 21, 'name' => 'Prospect Angry- Prospect was angry/yelling yet was still transferred'],
        	['code' => 22, 'name' => 'Prospect Confused- clearly confused and seems to have no idea what\'s going on'],
        	['code' => 23, 'name' => 'Prospect Confused- Elderly prospect that doesn\'t understand the call\'s purpose and just answering questions'],
        	['code' => 24, 'name' => 'Prospect Confused- incoherent/not answering clearly; doesn\'t seem to have an idea of the call\'s purpose'],
        	['code' => 25, 'name' => 'Prospect Sarcastic- prospect was sarcastic; agent did not understand the sarcasm and transferred'],
        	['code' => 26, 'name' => 'Prospect Sarcastic- prospect was sarcastic; agent understood or seemed to understand the sarcasm and transferred'],
        	['code' => 27, 'name' => 'Script Adherence- Agent deviated from from the script; one or more vital questions'],
        	['code' => 28, 'name' => 'Script Adherence- Agent deviated from the intro and purpose script'],
        	['code' => 29, 'name' => 'Script Adherence- Agent deviated from the purpose script'],
        	['code' => 30, 'name' => 'Script Adherence- Agent skipped questions']
        ];

        foreach($observations as $observation){
        	$o = new GeneralObservation;
        	$o->code = $observation['code'];
        	$o->name = $observation['name'];
        	$o->save();
        }
    }
}
