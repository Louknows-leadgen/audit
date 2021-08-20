<?php

use Illuminate\Database\Seeder;
use App\Models\Host;

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $hosts = [
        	// CL1
        	['server'=> '38.102.225.152', 'hostname' => 'http://38.102.225.152', 'cluster' => 1],
        	['server'=> '38.102.225.162', 'hostname' => 'http://38.102.225.162', 'cluster' => 1],
        	['server'=> '38.102.225.163', 'hostname' => 'http://38.102.225.163', 'cluster' => 1],
        	['server'=> '38.102.225.164', 'hostname' => 'http://38.102.225.164', 'cluster' => 1],
        	['server'=> '38.102.225.165', 'hostname' => 'http://38.102.225.165', 'cluster' => 1],
        	['server'=> '38.102.225.166', 'hostname' => 'http://38.102.225.166', 'cluster' => 1],
        	['server'=> '38.102.225.167', 'hostname' => 'http://38.102.225.167', 'cluster' => 1],
        	['server'=> '38.102.225.168', 'hostname' => 'http://38.102.225.168', 'cluster' => 1],
        	['server'=> '38.102.225.169', 'hostname' => 'http://38.102.225.169', 'cluster' => 1],
        	// CL2
        	['server'=> '38.102.225.153', 'hostname' => 'http://38.102.225.153', 'cluster' => 2],
        	['server'=> '38.102.225.170', 'hostname' => 'http://38.102.225.170', 'cluster' => 2],
        	['server'=> '38.102.225.171', 'hostname' => 'http://38.102.225.171', 'cluster' => 2],
        	['server'=> '38.107.174.240', 'hostname' => 'http://38.107.174.240', 'cluster' => 2],
        	['server'=> '38.107.174.241', 'hostname' => 'http://38.107.174.241', 'cluster' => 2],
        	['server'=> '38.107.174.242', 'hostname' => 'http://38.107.174.242', 'cluster' => 2],
        	['server'=> '38.107.174.243', 'hostname' => 'http://38.107.174.243', 'cluster' => 2],
        	['server'=> '38.107.174.247', 'hostname' => 'http://38.107.174.247', 'cluster' => 2],
        	['server'=> '38.107.174.248', 'hostname' => 'http://38.107.174.248', 'cluster' => 2],
        	// CL3
        	['server'=> '38.107.183.3', 'hostname' => 'http://38.107.183.3', 'cluster' => 3],
        	['server'=> '38.107.183.4', 'hostname' => 'http://38.107.183.4', 'cluster' => 3],
        	['server'=> '38.107.183.5', 'hostname' => 'http://38.107.183.5', 'cluster' => 3],
        	['server'=> '38.107.183.6', 'hostname' => 'http://38.107.183.6', 'cluster' => 3],
        	['server'=> '38.107.183.7', 'hostname' => 'http://38.107.183.7', 'cluster' => 3],
        	['server'=> '38.107.183.8', 'hostname' => 'http://38.107.183.8', 'cluster' => 3],
        	['server'=> '38.107.183.9', 'hostname' => 'http://38.107.183.9', 'cluster' => 3],
        	['server'=> '38.107.183.10', 'hostname' => 'http://38.107.183.10', 'cluster' => 3],
        	['server'=> '38.107.183.11', 'hostname' => 'http://38.107.183.11', 'cluster' => 3],
        	['server'=> '38.107.183.12', 'hostname' => 'http://38.107.183.12', 'cluster' => 3],
        	// CL4
        	['server'=> '161.49.118.21', 'hostname' => 'http://161.49.118.21', 'cluster' => 4],
        	['server'=> '161.49.118.22', 'hostname' => 'http://161.49.118.22', 'cluster' => 4],
        	['server'=> '161.49.118.23', 'hostname' => 'http://161.49.118.23', 'cluster' => 4],
        	['server'=> '161.49.118.24', 'hostname' => 'http://161.49.118.24', 'cluster' => 4],
        	['server'=> '161.49.118.25', 'hostname' => 'http://161.49.118.25', 'cluster' => 4],
        	['server'=> '161.49.118.26', 'hostname' => 'http://161.49.118.26', 'cluster' => 4],
        	// CL5
        	['server'=> '161.49.118.20', 'hostname' => 'http://161.49.118.20', 'cluster' => 5],
        	// CL6
        	['server'=> '207.188.12.131', 'hostname' => 'https://leadgen.phdialer.com', 'cluster' => 6],
        	['server'=> '207.188.12.22', 'hostname' => 'https://phxt22.phxdcnet.com', 'cluster' => 6],
        	['server'=> '207.188.12.238', 'hostname' => 'http://207.188.12.238', 'cluster' => 6],
        	['server'=> '207.188.12.239', 'hostname' => 'http://207.188.12.239', 'cluster' => 6],
        	['server'=> '207.188.12.24', 'hostname' => 'https://phxt24.phxdcnet.com', 'cluster' => 6],
        	['server'=> '207.188.12.33', 'hostname' => 'https://phxt33.phxdcnet.com', 'cluster' => 6],
        	['server'=> '207.188.12.34', 'hostname' => 'https://phxt34.phxdcnet.com', 'cluster' => 6],
        	['server'=> '207.188.12.35', 'hostname' => 'https://phxt35.phxdcnet.com', 'cluster' => 6],
        	['server'=> '207.188.12.65', 'hostname' => 'http://207.188.12.65', 'cluster' => 6]
        ];

        foreach ($hosts as $host) {
        	Host::firstOrCreate($host);
        }
    }
}
