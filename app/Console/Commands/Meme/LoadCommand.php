<?php

namespace App\Console\Commands\Meme;

use App\Models\PhotoLinks;
use App\Models\Settings;
use App\Services\Messages\Provider\Telegram\Telegram;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class LoadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meme:load';

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
        if (Cache::get('search_thread')) {
            return Command::SUCCESS;
        }
        $chat = '-1001897151240';
        $getThread = Settings::orderby('id','desc')->first();
        $res = Http::get('https://2ch.hk/api/mobile/v2/after/b/'.$getThread->thread_id .'/'.$getThread->last_thread_id)->json();
        if (isset($res['error'])) {
            $getThread->delete();
            Cache::put('search_thread',1, now()->addMinutes(10));
            (new Telegram)->send(
                $chat,
                'Тред удален. Найди новый, одебилевший от нихуя неделания долбоеб. Извените, сегодня больше без мэмов',
                Telegram::SEND_MESSAGE,
                Telegram::TYPE_TEXT
            );
            return Command::FAILURE;
        }
        $last_id = '';
        foreach ($res['posts'] as $post) {
            if (!isset($post['files'])) {
                continue;
            }
            foreach ($post['files'] as $arrayLink) {
                PhotoLinks::firstOrCreate([
                    'thread_id' => $getThread->thread_id,
                    'link' => $arrayLink['path'],
                ]);
            }
            $last_id = $post['num'];
        }
        $getThread->last_thread_id = $last_id;
        $getThread->save();
        return Command::SUCCESS;
    }
}
