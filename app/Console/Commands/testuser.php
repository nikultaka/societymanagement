<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class testuser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testuser:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Receipt Generat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $i=0;
       $data['name']='sunny'.$i;   
      DB::table('test')->insert($data);
      $i++;
    }
}
