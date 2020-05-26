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
     * @var Config|null
     */
    private $configs = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->configs = Config::getInstance();

        $this->apiKey = $this->configs->get('notifier.fcm.api_key');
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

    /**
     * @param $topic
     * @param array $devices
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createTopic($topic, $devices = [])
    {
        return $this->client->request('POST', $this->iidUrl . "/v1:batchAdd", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Authorization" => "key=" . $this->getApiKey(),
                "Content-Type" => "application/json"
            ],
            'body' => json_encode([
                'to' => $topic,
                'registration_tokens' => $devices
            ])
        ]);
    }

    /**
     * @param $deviceId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTopics($deviceId)
    {
        return $this->client->request('GET', $this->iidUrl . '/info/' . $deviceId, [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Authorization" => "key=" . $this->getApiKey(),
                "Content-Type" => "application/json"
            ],
            'query' => [
                'details' => true
            ]
        ]);
    }

    /**
     * @param $topic
     * @param array $devices
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function removeTopic($topic, $devices = [])
    {
        return $this->client->request('POST', $this->iidUrl . "/v1:batchRemove", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Authorization" => "key=" . $this->getApiKey(),
                "Content-Type" => "application/json"
            ],
            'body' => json_encode([
                'to' => $topic,
                'registration_tokens' => $devices
            ])
        ]);
    }
}
