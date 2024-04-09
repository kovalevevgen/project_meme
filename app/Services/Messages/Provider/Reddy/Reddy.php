<?php

namespace App\Services\Messages\Provider\Reddy;

use App\Models\Bots;
use App\Services\Messages\Provider\MessageProviderInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Reddy implements MessageProviderInterface
{


    public function send(mixed $receiver, Bots $bot, string $message, string $endpoint, string $messageType) : Response
    {
        $response = Http::asForm(
        )->post(
            'https://bot.reddy.team/bot' . $bot->token . '/' . $endpoint,
            [
                'msg' => $message,
                'userkey' => $receiver,
            ]
        );
        return $response;
    }
}