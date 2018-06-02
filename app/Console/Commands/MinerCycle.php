<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserMiner;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MinerCycle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'miner:cycle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Miner Cycle';

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
        DB::beginTransaction();
        try{
            $userminers = UserMiner::where('status' , 'working')->get();
            $time = Carbon::now()->toDateTimeString();
            if(count($userminers)){
                $this->output->progressStart($userminers->count());
                foreach ($userminers as $userminer){

                    $finished = $userminer->finished;

                    $timelong = $userminer->miner->timelong * 60 * 60; // 秒

                    $cycle_time = date('Y-m-d H:i:s' , strtotime($userminer->updated_at) + $timelong);
                    if($cycle_time < $time){
                        $coin = $userminer->miner->income * $userminer->number;
                        User::where('id' , '=' ,$userminer->user_id)->increment('coin' , $coin);
                        $userminer->finished = $finished+1;

                        if($finished + 1 == $userminer->miner->cycle){
                            $userminer->status = "over";
                        }

                        $userminer->save();
                    }
                    $this->output->progressAdvance();
                }
            }
            $this->output->progressFinish();
            Log::info("[UserMiner duty over]");

            $this->info("UserMiner duty over");
            DB::commit();
        }catch (\Exception $e){
            Log::error("error code:".$e->getCode() . ' , message :' . $e->getMessage() . ' , file :' . $e->getFile() . ' , line :' . $e->getLine());
            $this->error($e);
            DB::rollback();
        }


    }
}
