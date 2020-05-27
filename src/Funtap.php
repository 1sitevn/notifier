<?php


namespace OneSite\Notifier;

use GuzzleHttp\Client;

/**
 * Class Funtap
 * @package OneSite\Notifier
 */
class Funtap implements Notification
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

        $this->apiUrl = $this->configs->get('notifier.funtap.api_url');
        $this->apiKey = $this->configs->get('notifier.funtap.api_key');
        $this->companyId = $this->configs->get('notifier.funtap.company_id');
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
