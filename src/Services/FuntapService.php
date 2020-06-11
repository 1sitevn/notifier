<?php


namespace OneSite\Notifier\Services;

use GuzzleHttp\Client;
use OneSite\Notifier\Config;
use OneSite\Notifier\Contracts\NotificationInterface;


/**
 * Class FuntapService
 * @package OneSite\Notifier\Services
 */
class FuntapService implements NotificationInterface
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
    private $companyId = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->apiUrl = config('notifier.funtap.api_url');
        $this->apiKey = config('notifier.funtap.api_key');
        $this->companyId = config('notifier.funtap.company_id');
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
        return $this->client->request('POST', $this->apiUrl . "/api/sms/send-otp", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "X-Authorization" => $this->apiKey,
                "Content-Type" => "application/json"
            ],
            'body' => json_encode([
                'company_id' => $this->companyId,
                'phone' => $to,
                'otp' => !empty($data['body']) ? $data['body'] : '',
                'otp_life_time' => 5
            ])
        ]);
    }

}
