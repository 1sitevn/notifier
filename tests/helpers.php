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