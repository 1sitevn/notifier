<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Funtap;
use PHPUnit\Framework\TestCase;

require_once "helpers.php";


/**
 * Class FuntapTest
 * @package OneSite\Notifier\Tests
 */
class FuntapTest extends TestCase
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

        $this->notify = new Funtap();
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
     * PHPUnit test: vendor/bin/phpunit --filter testSendToDevice tests/FuntapTest.php
     */
    public function testSendToDevice()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_FUNTAP_PHONE_TEST'), [
            'body' => '123456'
        ]);

        echo "\n\n" . json_encode($response);

        $this->assertTrue(true);
    }

}
