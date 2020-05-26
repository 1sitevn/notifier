<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\CallCenter;
use PHPUnit\Framework\TestCase;

require_once "helpers.php";


/**
 * Class CallCenterTest
 * @package OneSite\Notifier\Tests
 */
class CallCenterTest extends TestCase
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

        $this->notify = new CallCenter();
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
     * PHPUnit test: vendor/bin/phpunit --filter testSendToDevice tests/CallCenterTest.php
     */
    public function testSendToDevice()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_CALL_CENTER_PHONE_TEST'), [
            'otp' => '123456'
        ]);

        $data = json_decode($response->getBody()->getContents());

        echo "\n\n" . json_encode($data);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(1, $data->status);
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testGetAccessToken tests/CallCenterTest.php
     */
    public function testGetAccessToken()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->getAccessToken();

        $data = json_decode($response->getBody()->getContents());

        echo "\n\n" . json_encode($data);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(1, $data->status);
    }

}
