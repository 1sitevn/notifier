<?php


namespace OneSite\Notifier\Services;

use GuzzleHttp\Client;
use OneSite\Notifier\Contracts\NotificationInterface;

/**
 * Class SouthTelecomService
 * @package OneSite\Notifier\Services
 */
class SouthTelecomService implements NotificationInterface
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array|mixed|null
     */
    private $apiUrl = null;
    /**
     * @var array|mixed|null
     */
    private $apiKey = null;

    /**
     * @var array|mixed|null
     */
    private $branchName = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->apiUrl = config('notifier.south_telecom.api_url');
        $this->apiKey = config('notifier.south_telecom.api_key');
        $this->branchName = config('notifier.south_telecom.brand_name');
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
        $apiUrl = $this->apiUrl . "/sendSMS";

        $phone = str_replace('/^0/', '84', $to);

        $params = [
            'from' => $this->branchName,
            'to' => $phone,
            'text' => !empty($data['body']) ? $data['body'] : ''
        ];

        return $this->client->request('POST', $apiUrl, [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Content-Type" => "application/json",
                "Accept" => "application/json",
                "Authorization" => "Basic =" . $this->apiKey,
            ],
            'body' => json_encode($params)
        ]);
    }

}
