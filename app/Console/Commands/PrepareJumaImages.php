<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TelegramUser;
use App\Jobs\SendJumaImageToTelegram;


class PrepareJumaImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:juma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare jobs for telegram bulk juma images';

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

        foreach($users as $user) 
        {
            SendJumaImageToTelegram::dispatch($user)->delay(now()->addSeconds(0 + $i));
            $i++;
        }

        $this->info("$i jobs dispatched");
    }
}
