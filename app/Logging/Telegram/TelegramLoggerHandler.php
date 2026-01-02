<?php

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;

final class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected int $chatId;
    protected string $token;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level'] ?? 'debug');
        parent::__construct($level);

        $this->chatId = (int) ($config['chat_id'] ?? 0);
        $this->token  = (string) ($config['token'] ?? '');
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    protected function write(LogRecord $record): void
    {
        $text = (string) ($record->formatted ?? $record->message);

        TelegramBotApi::sendMessage(
            $this->token,
            $this->chatId,
            $text
        );
    }
}
