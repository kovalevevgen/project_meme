<?php

namespace App\Services\Messages\Provider\Telegram;

use App\Services\Messages\Provider\MessageProviderInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Telegram implements MessageProviderInterface
{
    const SEND_MESSAGE = 'sendMessage';
    const SEND_MEDIA_GROUP = 'sendMediaGroup';

    const TYPE_TEXT = 'text';
    const TYPE_MEDIA = 'media';

    protected $token = '6005932944:AAHFPLSTYTL6KIofqSodak9w6QJtfOpT49Q';
    /**
     * @inheritDoc
     */
    public function send(mixed $receiver, string $message, string $endpoint, string $messageType) : Response
    {
        $response = Http::post(
            'https://api.telegram.org/bot' . $this->token . '/' . $endpoint,
            [
                'chat_id' => $receiver,
                $messageType => $message,
            ]
        );
        return $response;
    }
}