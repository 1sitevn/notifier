<?php

namespace OneSite\Notifier;


use GuzzleHttp\Client;

/**
 * Class CallCenter
 * @package OneSite\Notifier
 */
class CallCenter implements Notification
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

        $this->apiUrl = $this->configs->get('notifier.call_center.api_url');
        $this->secretKey = $this->configs->get('notifier.call_center.secret_key');
        $this->accessToken = $this->configs->get('notifier.call_center.access_token');
        $this->campaignId = $this->configs->get('notifier.call_center.campaign_id');
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
                        'otp_code' => !empty($data['otp']) ? $data['otp'] : null
                    ]
                ]
            ])
        ]);
    }
}
