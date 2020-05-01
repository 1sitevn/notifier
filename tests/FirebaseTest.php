<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Firebase;
use PHPUnit\Framework\TestCase;

/**
 * Class FirebaseTest
 * @package OneSite\Notifier\Tests
 */
class FirebaseTest extends TestCase
{

    /**
     *
     */
    public function testSendToDevice()
    {
        $firebase = new Firebase();

        $body = [
            'title' => 'Test send to Device',
            'description' => 'Test send to Device',
            'type' => 'test_device'
        ];

        /**
         * @var Response $response
         */
        $response = $firebase->send($_ENV['NOTIFIER_FIREBASE_TO_DEVICE'], $body);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        $this->assertEquals(1, $data->success);
    }

    /**
     *
     */
    public function testSendToTopic()
    {
        $firebase = new Firebase();

        $body = [
            'title' => 'Test send to Topic',
            'description' => 'Test send to Topic',
            'type' => 'test_topic'
        ];

        /**
         * @var Response $response
         */
        $response = $firebase->send($_ENV['NOTIFIER_FIREBASE_TO_TOPIC'], $body);

        $this->assertEquals(200, $response->getStatusCode());
    }
}