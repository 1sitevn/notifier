<?php


namespace OneSite\Notifier\Services;

use GuzzleHttp\Client;
use OneSite\Notifier\Contracts\NotificationInterface;

/**
 * Class CMCService
 * @package OneSite\Notifier\Services
 */
class CMCService implements NotificationInterface
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
    private $branchName = null;

    /**
     * @var array|mixed|null
     */
    private $username = null;
    /**
     * @var array|mixed|null
     */
    private $password = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->apiUrl = config('notifier.cmc.api_url');
        $this->branchName = config('notifier.cmc.brand_name');
        $this->username = config('notifier.cmc.username');
        $this->password = config('notifier.cmc.password');
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
        $apiUrl = $this->apiUrl . "/Send";

        $isUft8 = !empty($options['utf8']) && $options['utf8'] ? true : false;
        if ($isUft8) {
            $apiUrl = $this->apiUrl . "/sendUTF";
        }

        $params = [
            'Brandname' => $this->branchName,
            'Phonenumber' => $to,
            'Message' => !empty($data['body']) ? $data['body'] : '',
            'SendTime' => date('Y-m-d H:i:s'),
            'user' => $this->username,
            'pass' => $this->password,
        ];

        $response = $this->client->request('POST', $apiUrl, [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Content-Type" => "application/json"
            ],
            'body' => json_encode($params)
        ]);

        $data = json_decode($response->getBody()->getContents());

        $metaData = [
            'method' => 'POST',
            'url' => $apiUrl,
            'headers' => [],
            'params' => $params
        ];

        if ($data->Code != 1) {
            return [
                'error' => [
                    'code' => $data->Code,
                    'message' => $data->Description
                ],
                'meta_data' => $metaData
            ];
        }

        if ($data->Data->Status == 1) {
            return [
                'data' => $data,
                'meta_data' => $metaData
            ];
        }

        return [
            'error' => [
                'code' => $data->Data->Status,
                'message' => $data->Data->StatusDescription
            ],
            'meta_data' => $metaData
        ];
    }

}
