<?php

use Illuminate\Database\Seeder;
use App\Models\Server;

class ServersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $servers = [
        	['code' => 1, 'name' => '38.107.183.5', 'short_desc' => 'Cluster 1 server']
        ];

        foreach ($servers as $server) {
        	$s = new Server;
        	$s->code = $server['code'];
        	$s->name = $server['name'];
        	$s->short_desc = $server['short_desc'];
        	$s->save();
        }
    }
}
