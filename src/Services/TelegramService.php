<?php


namespace OneSite\Notifier\Services;

use GuzzleHttp\Client;
use OneSite\Notifier\Contracts\NotificationInterface;


/**
 * Class TelegramService
 * @package OneSite\Notifier\Services
 * https://medium.com/@wk0/send-and-receive-messages-with-the-telegram-api-17de9102ab78
 * https://medium.com/@xabaras/sending-a-message-to-a-telegram-channel-the-easy-way-eb0a0b32968
 * Invite @getidsbo or @RawDataBot to your group and get your group id in sended chat id field.
 */
class TelegramService implements NotificationInterface
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array|mixed|null
     */
    private $apiUrl = 'https://api.telegram.org';
    /**
     * @var array|mixed|null
     */
    private $botName = null;

    /**
     * @var array|mixed|null
     */
    private $botToken = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->botName = config('notifier.telegram.bot_name');
        $this->botToken = config('notifier.telegram.bot_token');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getChatBotUrl()
    {
        return "https://telegram.me/{$this->botName}?start=" . bin2hex(random_bytes(8));
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * $ /newbot
     * $ TikopAlertBot
     * $ /688581560 @TikopAlertBot
     */
    public function getUpdates()
    {
        return $this->client->request('GET', $this->apiUrl . '/bot' . $this->botToken . '/getUpdates');
    }

    /**
     * @param $to
     * @param $data
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($to, $data, $options = [])
    {
        return $this->client->request('GET', $this->apiUrl . '/bot' . $this->botToken . '/sendMessage', [
            'http_errors' => false,
            'verify' => false,
            'query' => [
                'chat_id' => $to,
                'text' => !empty($data['body']) ? $data['body'] : '',
                'parse_mode' => 'HTML'
            ]
        ]);
    }

}
