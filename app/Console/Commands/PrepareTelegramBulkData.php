<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramUser;
use App\Jobs\SendDataToTelegram;

class PrepareTelegramBulkData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:prepare';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepares jobs for telegram bulk notifications';

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
     * @return int
     */
    public function handle()
    {
        $i = 0;
        $users = TelegramUser::where("city_id", "<>", null)
                             ->where("language", "<>", null)
                             ->where("is_subscribed", 1)
                             ->lazy();
        // $users = TelegramUser::whereIn("id", [4,5])->get();

        foreach($users as $user) 
        {
            SendDataToTelegram::dispatch($user)->delay(now()->addSeconds(0 + $i));
            $i++;
        }

        $this->info("$i jobs dispatched");
    }
}
