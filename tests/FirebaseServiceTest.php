<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\FirebaseService;
use PHPUnit\Framework\TestCase;

/**
 * Class FirebaseServiceTest
 * @package OneSite\Notifier\Tests
 * PHPUnit test: vendor/bin/phpunit tests/FirebaseTest.php
 */
class FirebaseServiceTest extends TestCase
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

        $this->notify = new FirebaseService();
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @throws \GuzzleHttp\Exception\GuzzleException
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


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreateTopic()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->createTopic('/topics/test', [
            env('NOTIFIER_FIREBASE_TO_DEVICE')
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetTopics()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->getTopics(env('NOTIFIER_FIREBASE_TO_DEVICE'));

        $httpStatusCode = $response->getStatusCode();
        if (200 == $httpStatusCode) {
            print_r("\n" . $response->getBody()->getContents());
        }

        $this->assertEquals(200, $response->getStatusCode(), $response->getBody()->getContents());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testRemoveTopic()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->removeTopic('/topics/test', [
            env('NOTIFIER_FIREBASE_TO_DEVICE')
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
