<?php

namespace OneSite\Notifier\Services;


use GuzzleHttp\Client;
use OneSite\Notifier\Config;
use OneSite\Notifier\Contracts\NotificationInterface;


/**
 * Class CallCenterService
 * @package OneSite\Notifier\Services
 */
class CallCenterService implements NotificationInterface
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
     * @var null
     */
    private $secretKey = null;
    /**
     * @var array|mixed|null
     */
    private $accessToken = null;
    /**
     * @var array|mixed|null
     */
    private $campaignId = null;


    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->apiUrl = config('notifier.call_center.api_url');
        $this->secretKey = config('notifier.call_center.secret_key');
        $this->accessToken = config('notifier.call_center.access_token');
        $this->campaignId = config('notifier.call_center.campaign_id');
    }


    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken()
    {
        $apiUrl = $this->apiUrl . "users/generate-access-token?secret_key=" . $this->secretKey;

        return $this->client->request('GET', $apiUrl);
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
        $apiUrl = $this->apiUrl . 'campaigns/' . $this->campaignId . '/import?access_token=' . $this->accessToken;

        return $this->client->request('POST', $apiUrl, [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Content-Type" => "application/json"
            ],
            'body' => json_encode([
                'contacts' => [
                    [
                        'phone_number' => $to,
                        'otp_code' => !empty($data['body']) ? $data['body'] : null
                    ]
                ]
            ])
        ]);
    }
}
