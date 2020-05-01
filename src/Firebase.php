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
     * @param $to
     * @param $data
     * @param array $options
     * @return array|mixed
     */
    public function send($to, $data, $options = [])
    {
        $url = "https://fcm.googleapis.com/fcm/send";

        $headers = [
            "Authorization" => "key=AAAA3JvgGnU:APA91bHIwO_n7R6z2oWV-m08dG4-mm2uPCE7CYQG_QBsfrz5QY1lzsSzfcSi34h8Bli3rKBKAoN_0PIY-w4KC1BvYd1jUR4jvjT66aJN-cYlWHRfjxXJ6Yb1dZL4X3uBBaY8zVBj3Usw",
            "Content-Type" => "application/json"
        ];

        $client = new Client();

        return $client->request('POST', $url, [
            'http_errors' => false,
            'verify' => false,
            'headers' => $headers,
            'body' => json_encode([
                'to' => $to,
                'content-available' => true,
                'priority' => 'HIGH',
                'data' => $data
            ])
        ]);
    }

}
