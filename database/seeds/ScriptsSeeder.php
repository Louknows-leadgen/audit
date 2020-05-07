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
        	['code'=>1,'name'=>'z01','short_desc'=>'script 01'],
            ['code'=>2,'name'=>'z02','short_desc'=>'script 02'],
            ['code'=>3,'name'=>'z03','short_desc'=>'script 03'],
            ['code'=>4,'name'=>'z04','short_desc'=>'script 04'],
            ['code'=>16,'name'=>'z16','short_desc'=>'script 16'],
            ['code'=>5,'name'=>'z05','short_desc'=>'script 05'],
            ['code'=>6,'name'=>'z06','short_desc'=>'script 06'],
            ['code'=>7,'name'=>'z07','short_desc'=>'script 07'],
            ['code'=>15,'name'=>'z15','short_desc'=>'script 15'],
            ['code'=>8,'name'=>'z08','short_desc'=>'script 08'],
            ['code'=>9,'name'=>'z09','short_desc'=>'script 09'],
            ['code'=>10,'name'=>'z10','short_desc'=>'script 10'],
            ['code'=>11,'name'=>'z11','short_desc'=>'script 11'],
            ['code'=>12,'name'=>'z12','short_desc'=>'script 12']
        ];

        foreach ($scripts as $script) {
            $s = new Script;
            $s->code = $script['code'];
            $s->name = $script['name'];
            $s->short_desc = $script['short_desc'];
            $s->save();
        }
    }
}
