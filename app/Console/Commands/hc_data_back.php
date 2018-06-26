<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class hc_data_back extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:all_database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '定时备份数据库';

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
        //
        \Log::info("开启定时任务啦！");
    }
}
