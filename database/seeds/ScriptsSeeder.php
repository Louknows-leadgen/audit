<?php

use Illuminate\Database\Seeder;
use App\Models\Script;

class ScriptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $scripts = [
        	['name'=>'z01','short_desc'=>'script 01'],
            ['name'=>'z02','short_desc'=>'script 02'],
            ['name'=>'z03','short_desc'=>'script 03'],
            ['name'=>'z04','short_desc'=>'script 04'],
            ['name'=>'z15','short_desc'=>'script 05'],
            ['name'=>'z06','short_desc'=>'script 06'],
            ['name'=>'z07','short_desc'=>'script 07'],
            ['name'=>'z08','short_desc'=>'script 08'],
            ['name'=>'z16','short_desc'=>'script 16'],
            ['name'=>'z09','short_desc'=>'script 09'],
            ['name'=>'z10','short_desc'=>'script 10'],
            ['name'=>'z11','short_desc'=>'script 11'],
            ['name'=>'z12','short_desc'=>'script 12']
        ];

        foreach ($scripts as $script) {
            $s = new Script;
            $s->name = $script['name'];
            $s->short_desc = $script['short_desc'];
            $s->save();
        }
    }
}
