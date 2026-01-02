<?php

namespace App\Services\Telegram;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public static function sendMessage(string $token, int $chat_id, string $text): void
    {
        Http::asForm()->post(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $text,
            'disable_web_page_preview' => true,
        ])->throw();
    }
}
