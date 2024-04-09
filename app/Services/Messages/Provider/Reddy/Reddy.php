<?php

namespace App\Services\Messages\Provider\Reddy;

use App\Services\Messages\Provider\MessageProviderInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Reddy implements MessageProviderInterface
{

    protected $token = '3cuwl3-JDAG-fbBWdKVaxqjR_m3w6pC0';
    public function send(mixed $receiver, string $message, string $endpoint, string $messageType) : Response
    {
        $response = Http::asForm(
        )->post(
            'https://bot.reddy.team/bot' . $this->token . '/' . $endpoint,
            [
                'msg' => $message,
                'userkey' => $receiver,
            ]
        );
        return $response;
    }
}