<?php

if (!function_exists('config')) {
    /**
     * @param $key
     * @param null $default
     * @return array|mixed|null
     */
    function config($key, $default = null)
    {
        $configs = [
            'notifier' => [
                'fcm' => [
                    'api_key' => env('NOTIFIER_FIREBASE_KEY', null)
                ],

                'call_center' => [
                    'username' => env('NOTIFIER_CALL_CENTER_USERNAME', null),
                    'password' => env('NOTIFIER_CALL_CENTER_PASSWORD', null),
                    'api_url' => env('NOTIFIER_CALL_CENTER_API_URL', null),
                    'secret_key' => env('NOTIFIER_CALL_CENTER_SECRET_KEY', null),
                    'access_token' => env('NOTIFIER_CALL_CENTER_ACCESS_TOKEN', null),
                    'campaign_id' => env('NOTIFIER_CALL_CENTER_CAMPAIGN_ID', null),
                ],

                'twilio' => [
                    'id' => env('NOTIFIER_TWILIO_ID', null),
                    'token' => env('NOTIFIER_TWILIO_TOKEN', null),
                    'from' => env('NOTIFIER_TWILIO_FROM', null),
                ]
            ]
        ];

        $data = $configs;

        $keys = explode('.', $key);

        foreach ($keys as $_key) {
            if (isset($data[$_key])) {
                $data = $data[$_key];

                continue;
            }

            return $default;
        }

        return $data;
    }
}

if (!function_exists('env')) {
    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    function env($key, $default = null)
    {
        return !empty($_ENV[$key]) ? $_ENV[$key] : $default;
    }
}
