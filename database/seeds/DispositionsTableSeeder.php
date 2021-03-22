<?php

use Illuminate\Database\Seeder;
use App\Models\Disposition;

class DispositionsTableSeeder extends Seeder
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
            ' ',
			'A',
			'AA',
			'AB',
			'ADC',
			'AFTHRS',
			'B',
			'CALLBK',
			'CBHOLD',
			'DAIR',
			'DC',
			'DEAD',
			'DEC',
			'DNC',
			'DROP',
			'DTO',
			'DUMP',
			'HUP',
			'INCALL',
			'InsHUP',
			'Lang',
			'LRERR',
			'MAXCAL',
			'N',
			'NA',
			'NI',
			'NP',
			'NQ',
			'NRN',
			'Prank',
			'PU',
			'RD',
			'RING',
			'ROBOT',
			'SALE',
			'STSUC',
			'TIMEOT',
			'TrFail',
			'TRHUP',
			'TrSuc',
			'VM',
			'WRNGN',
			'XFER'
        ];

        foreach ($dispositions as $d) {
        	$dispo = new Disposition;
        	$dispo->short_name = $d;
        	$dispo->long_name = $d;
        	$dispo->save();
        }

    }
}
