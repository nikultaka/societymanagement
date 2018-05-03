<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ReceiptPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ReceiptPayment:name';

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
          
       $data= DB::table('house_managment')
                ->join('charges_list', 'house_managment.house_block_id', '=', 'charges_list.block_id')
                ->where('house_managment.status','=','1')
                ->select('house_managment.id', 'charges_list.id as charge_id')
                ->get();
      $first_day_this_month = date('m-01-Y');
      $last_day_this_month  = date('m-t-Y');
       foreach ($data as $key=>$value){
           $data_result=array();
           $data_result['house_managment_id'] =$value->id;
           $data_result['charges_id']=$value->charge_id;
           $data_result['start_date']=$first_day_this_month;
           $data_result['end_date']=$last_day_this_month;
           $data_result['status']=0;
           $cart[]=$data_result;
       }
       foreach ($cart as $data){
           DB::table('house_receipts')->insert($data);
       }
    }
}
