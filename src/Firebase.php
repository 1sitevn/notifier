<?php

namespace OneSite\Notifier;


use GuzzleHttp\Client;

/**
 * Class Firebase
 * @package OneSite\Notifier
 */
class Firebase implements Notification
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $fcmUrl = "https://fcm.googleapis.com/fcm";
    /**
     * @var string
     */
    private $iidUrl = "https://iid.googleapis.com/iid";

    /**
     * @var null
     */
    private $apiKey = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->apiKey = Config::get('notifier.fcm.api_key');
    }

    /**
     * @return null
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param null $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param $to
     * @param $data
     * @param array $options
     * @return array|mixed
     */
    public function send($to, $data, $options = [])
    {
        return $this->client->request('POST', $this->fcmUrl . "/send", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Authorization" => "key=" . $this->getApiKey(),
                "Content-Type" => "application/json"
            ],
            'body' => json_encode([
                'to' => $to,
                'content-available' => true,
                'priority' => 'HIGH',
                'data' => $data
            ])
        ]);
    }

}
