<?php

namespace App\Logging\Telegram;
use App\Services\Telegram\TelegramBotApi;
use Monolog\Logger;

class TelegramLoggerFactory
{

    public function __invoke(array $config): Logger
    {
        $logger = new Logger('telegram');
        $logger->pushHandler(new TelegramLoggerHandler($config));

        return $logger;
    }
}
