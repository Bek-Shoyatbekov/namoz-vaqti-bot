<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\TelegramUser;
use App\Http\Services\TelegramService;

class SendJumaImageToTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TelegramUser $user)
    {
                $this->user = $user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new TelegramService($this->user->tg_user_id);
        $a = $service->sendJumaImage();
    }
}
