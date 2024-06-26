<?php

namespace App\Services\Messages\Provider;


use App\Models\Bots;
use \Illuminate\Http\Client\Response;

interface MessageProviderInterface
{
    /**
     * Отправляет сообщение получателю
     * @param mixed $receiver Получатель/получатели
     * @param string $message Сообщение
     * @param string $endpoint Эндпоинт апи
     * @param string $messageType Тип сообщения (медиа, текст и т.д.)
     * @return bool
     */
    public function send (mixed $receiver,Bots $bot, string $message, string $endpoint, string $messageType): Response;
}
