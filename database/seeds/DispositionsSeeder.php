<?php

use Illuminate\Database\Seeder;
use App\Models\Disposition;

class DispositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dispositions = [
        	['code' => 1, 'name' => 'A', 'short_desc' => 'Answering Machine'],
        	['code' => 2, 'name' => 'AA', 'short_desc' => 'Answering Machine Auto'],
        	['code' => 3, 'name' => 'AB', 'short_desc' => 'Busy Auto'],
        	['code' => 4, 'name' => 'ADC', 'short_desc' => 'Disconnected Number Auto'],
        	['code' => 5, 'name' => 'ADCT', 'short_desc' => 'Disconnected Number Temporary'],
        	['code' => 6, 'name' => 'AFAX', 'short_desc' => 'Fax Machine Auto'],
        	['code' => 7, 'name' => 'AFTHRS', 'short_desc' => 'Inbound After Hours Drop'],
        	['code' => 8, 'name' => 'AL', 'short_desc' => 'Answering Machine Msg Played'],
        	['code' => 9, 'name' => 'AM', 'short_desc' => 'Answering Machine SentToMesg'],
        	['code' => 10, 'name' => 'B', 'short_desc' => 'Busy'],
        	['code' => 11, 'name' => 'CALLBK', 'short_desc' => 'Call Back'],
        	['code' => 12, 'name' => 'CBHOLD', 'short_desc' => 'Call Back Hold'],
        	['code' => 13, 'name' => 'DC', 'short_desc' => 'Disconnected Number'],
        	['code' => 14, 'name' => 'DEAD', 'short_desc' => 'Dead Air'],
        	['code' => 15, 'name' => 'DEC', 'short_desc' => 'Declined Sale'],
        	['code' => 16, 'name' => 'DNC', 'short_desc' => 'Do Not Call'],
        	['code' => 17, 'name' => 'DNCC', 'short_desc' => 'DO Not Call Hopper Camp Match'],
        	['code' => 18, 'name' => 'DNCL', 'short_desc' => 'Do Not Call Hopper Sys Match'],
        	['code' => 19, 'name' => 'DROP', 'short_desc' => 'Agent Not Available'],
        	['code' => 20, 'name' => 'DTO', 'short_desc' => 'Dial Time Out'],
        	['code' => 21, 'name' => 'DUMP', 'short_desc' => 'Dump Leads'],
        	['code' => 22, 'name' => 'ERI', 'short_desc' => 'Agent Error'],
        	['code' => 23, 'name' => 'HUP', 'short_desc' => 'Hang Up'],
        	['code' => 24, 'name' => 'INCALL', 'short_desc' => 'Lead Being Called'],
        	['code' => 25, 'name' => 'InsHUP', 'short_desc' => 'Insurance Hangup'],
        	['code' => 26, 'name' => 'IVRXFR', 'short_desc' => 'Outbound Drop to Call Menu'],
        	['code' => 27, 'name' => 'Lang', 'short_desc' => 'Language Barrier'],
        	['code' => 28, 'name' => 'LRERR', 'short_desc' => 'Outbound Local Channel Res Err'],
        	['code' => 29, 'name' => 'LSMERG', 'short_desc' => 'Agent lead search old lead mrg'],
        	['code' => 30, 'name' => 'MAXCAL', 'short_desc' => 'Inbound Max Calls Drop'],
        	['code' => 31, 'name' => 'MLINAT', 'short_desc' => 'Multi-Lead auto-alt set inactv'],
        	['code' => 32, 'name' => 'NA', 'short_desc' => 'No Answer AutoDial'],
        	['code' => 33, 'name' => 'NANQUE', 'short_desc' => 'Inbound No Agent No Queue Drop'],
        	['code' => 34, 'name' => 'NEW', 'short_desc' => 'New Lead'],
        	['code' => 35, 'name' => 'NI', 'short_desc' => 'Not Interested'],
        	['code' => 36, 'name' => 'noGED', 'short_desc' => 'No GEDHS Diploma'],
        	['code' => 37, 'name' => 'NP', 'short_desc' => 'No Pitch No Price'],
        	['code' => 38, 'name' => 'NQ', 'short_desc' => 'Not Qualified'],
        	['code' => 39, 'name' => 'NRN', 'short_desc' => 'Not Right Now'],
        	['code' => 40, 'name' => 'PDROP', 'short_desc' => 'Outbound Pre-Routing Drop'],
        	['code' => 41, 'name' => 'PM', 'short_desc' => 'Played Message'],
        	['code' => 42, 'name' => 'Prank', 'short_desc' => 'Prank Call'],
        	['code' => 43, 'name' => 'PU', 'short_desc' => 'Call Picked Up'],
        	['code' => 44, 'name' => 'QCFAIL', 'short_desc' => 'QC_FAIL_CALLBK'],
        	['code' => 45, 'name' => 'QUEUE', 'short_desc' => 'Lead To Be Called'],
        	['code' => 46, 'name' => 'QVMAIL', 'short_desc' => 'Queue Abandon Voicemail Left'],
        	['code' => 47, 'name' => 'RD', 'short_desc' => 'Redial'],
        	['code' => 48, 'name' => 'ROBOT', 'short_desc' => 'Suspect Robo Calling'],
        	['code' => 49, 'name' => 'RQXFER', 'short_desc' => 'Re-Queue'],
        	['code' => 50, 'name' => 'SVYCLM', 'short_desc' => 'Survey sent to Call Menu'],
        	['code' => 51, 'name' => 'SVYEXT', 'short_desc' => 'Survey sent to Extension'],
        	['code' => 52, 'name' => 'SVYHU', 'short_desc' => 'Survey Hungup'],
        	['code' => 53, 'name' => 'SVYREC', 'short_desc' => 'Survey sent to Record'],
        	['code' => 54, 'name' => 'SVYVM', 'short_desc' => 'Survey sent to Voicemail'],
        	['code' => 55, 'name' => 'TIMEOT', 'short_desc' => 'Inbound Queue Timeout Drop'],
        	['code' => 56, 'name' => 'TrFail', 'short_desc' => 'Transfer Failed'],
        	['code' => 57, 'name' => 'WRNGN', 'short_desc' => 'Wrong Number'],
        	['code' => 58, 'name' => 'XDROP', 'short_desc' => 'Agent Not Available IN'],
        	['code' => 59, 'name' => 'XFER', 'short_desc' => 'Call Transferred']
        ];

        foreach($dispositions as $dispo){
        	$d = new Disposition;
        	$d->code = $dispo['code'];
        	$d->name = $dispo['name'];
        	$d->short_desc = $dispo['short_desc'];
        	$d->save();
        }
    }
}
