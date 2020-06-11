<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\TwilioService;
use PHPUnit\Framework\TestCase;

/**
 * Class TwilioServiceTest
 * @package OneSite\Notifier\Tests
 */
class TwilioServiceTest extends TestCase
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

        $this->notify = new TwilioService();
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
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function testSendToDevice()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_TWILIO_PHONE_TEST'), [
            'body' => 'Ma xac thuc cua ban la 123456.'
        ]);

        echo "\n\n" . json_encode($response);

        $this->assertTrue(true);
    }

}
