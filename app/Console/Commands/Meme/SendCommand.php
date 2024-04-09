<?php

namespace App\Console\Commands\Meme;

use App\Models\PhotoLinks;
use App\Services\Messages\Provider\Telegram\Telegram;
use Illuminate\Console\Command;

class SendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meme:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getMemes = PhotoLinks::where(['flag' => 1])->limit(10)->get();
        $test = [];
        if ($getMemes->count() === 0) {
            return Command::FAILURE;
        }
        $getMemes->each(function ($mem) use (&$test) {
            $test[] = ['type' => 'photo', 'media' => 'https://2ch.hk/' . $mem->link];
            $mem->fill(['flag' => 0])->save();
        });
        $chat = '-1001897151240';
        (new Telegram)->send(
            $chat,
            json_encode($test),
            Telegram::SEND_MEDIA_GROUP,
            Telegram::TYPE_MEDIA
        );
        return Command::SUCCESS;
    }
}
