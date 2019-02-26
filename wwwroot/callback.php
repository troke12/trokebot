<?php // callback.php
define("LINE_MESSAGING_API_CHANNEL_SECRET", 'c50941ed7afdec174808ef73c5df5c93');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'z+JmaCop1/xi2EH1nhMoCEL44QcdBArVFhD5F6zgama2Bj4jFGwY3AAYfn2e6pYngKqjno7uJrob7W9rNRCC4pEtYWt9K9m6+763kzG9re1BloutMByHRybjtb7bsDUSHFIESNSlWQG85s9gVrGJtQdB04t89/1O/w1cDnyilFU=');

require __DIR__."/../vendor/autoload.php";

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }
}

echo "OK";