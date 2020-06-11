<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\FuntapService;
use PHPUnit\Framework\TestCase;

/**
 * Class FuntapServiceTest
 * @package OneSite\Notifier\Tests
 */
class FuntapServiceTest extends TestCase
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

        $this->notify = new FuntapService();
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
        $response = $this->notify->send(env('NOTIFIER_FUNTAP_PHONE_TEST'), [
            'body' => '123456'
        ]);

        echo "\n\n" . json_encode($response);

        $this->assertTrue(true);
    }

}
