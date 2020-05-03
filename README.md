Notifier
=======================

This package send notifications. Package is allowing send notifications with firebase, telegram, twilio,...

## Installation

Install MakeResource through Composer.

    "require": {
        "onesite/notifier": "~1.0"
    }
    
## Using the package

### Send notification with Firebase

    <?php

    use GuzzleHttp\Psr7\Response;
    use OneSite\Notifier\Firebase;
    
    /**
     * @var Response $response
     */
    $response = $this->notify->send(env('NOTIFIER_FIREBASE_TO_DEVICE'), [
        'title' => 'Test send to Device',
        'description' => 'Test send to Device',
        'type' => 'test_device'
    ]);    