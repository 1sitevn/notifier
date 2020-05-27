<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Twilio;
use PHPUnit\Framework\TestCase;

require_once "helpers.php";


class TwilioTest extends TestCase
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

        $this->notify = new Twilio();
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
     * PHPUnit test: vendor/bin/phpunit --filter testSendToDevice tests/TwilioTest.php
     */
    public function testSendToDevice()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_TWILIO_PHONE_TEST'), [
            'message' => 'Ma xac thuc cua ban la 123456.'
        ]);

        echo "\n\n" . json_encode($response);

        $this->assertTrue(true);
    }

}
