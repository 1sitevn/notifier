<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Firebase;
use PHPUnit\Framework\TestCase;

require_once "helpers.php";

/**
 * Class FirebaseTest
 * @package OneSite\Notifier\Tests
 */
class FirebaseTest extends TestCase
{
    /**
     * @var void|null
     */
    private $notify;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->notify = new Firebase();
    }

    /**
     *
     */
    public function tearDown(): void
    {
        $this->notify = null;

        parent::tearDown();
    }

    /**
     *
     */
    public function testSendToDevice()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_FIREBASE_TO_DEVICE'), [
            'title' => 'Test send to Device',
            'description' => 'Test send to Device',
            'type' => 'test_device'
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        $this->assertEquals(1, $data->success);
    }

    /**
     *
     */
    public function testSendToTopic()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_FIREBASE_TO_TOPIC'), [
            'title' => 'Test send to Topic',
            'description' => 'Test send to Topic',
            'type' => 'test_topic'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}