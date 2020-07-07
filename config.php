<?php

return [
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
        ],

        'funtap' => [
            'api_url' => env('NOTIFIER_FUNTAP_API_URL', null),
            'api_key' => env('NOTIFIER_FUNTAP_API_KEY', null),
            'company_id' => env('NOTIFIER_FUNTAP_COMPANY_ID', null),
        ],

        'cmc' => [
            'api_url' => env('NOTIFIER_CMC_API_URL', null),
            'brand_name' => env('NOTIFIER_CMC_BRAND_NAME', null),
            'username' => env('NOTIFIER_CMC_USERNAME', null),
            'password' => env('NOTIFIER_CMC_PASSWORD', null),
        ],

        'telegram' => [
            'bot_name' => env('NOTIFIER_TELEGRAM_BOT_NAME', null),
            'bot_token' => env('NOTIFIER_TELEGRAM_BOT_TOKEN', null),
            'chat_id' => env('NOTIFIER_TELEGRAM_CHAT_ID', null),
        ],

        'south_telecom' => [
            'api_url' => env('NOTIFIER_SOUTH_TELECOM_API_URL', null),
            'api_key' => env('NOTIFIER_SOUTH_TELECOM_API_KEY', null),
            'brand_name' => env('NOTIFIER_SOUTH_TELECOM_BRAND_NAME', null),
        ],
    ]
];
