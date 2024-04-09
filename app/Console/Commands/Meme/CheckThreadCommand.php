<?php

namespace App\Console\Commands\Meme;

use App\Models\Settings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class CheckThreadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-thread-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if  (Cache::get('search_thread')) {
            try {
                $getTreads = Http::get('https://2ch.hk/b/catalog.json')->json();
            } catch (\Exception $e) {}
            foreach ($getTreads['threads'] as $thread) {
                if (strpos($thread['comment'],'ZASMOBOS')) {
                    Cache::delete('search_thread')
                    (new Settings)->fill([
                        'thread_id' => $thread['num'],
                        'last_thread_id' => $thread['num']
                    ])->save();
                } else {
                    Cache::put('search_thread',1, now()->addMinutes(10));
                }
            }

        }
    }
}
