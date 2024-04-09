<?php

namespace App\Services\Messages\Provider\Telegram;

use App\Models\Bots;
use App\Services\Messages\Provider\MessageProviderInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Telegram implements MessageProviderInterface
{
    const SEND_MESSAGE = 'sendMessage';
    const SEND_MEDIA_GROUP = 'sendMediaGroup';

    const TYPE_TEXT = 'text';
    const TYPE_MEDIA = 'media';

    /**
     * @inheritDoc
     */
    public function send(mixed $receiver, Bots $bot, string $message, string $endpoint, string $messageType) : Response
    {
        $response = Http::post(
            'https://api.telegram.org/bot' . $bot->token . '/' . $endpoint,
            [
                'chat_id' => $receiver,
                $messageType => $message,
            ]
        );
        return $response;
    }
}