<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\CallCenterService;
use PHPUnit\Framework\TestCase;


/**
 * Class CallCenterServiceTest
 * @package OneSite\Notifier\Tests
 */
class CallCenterServiceTest extends TestCase
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

        $this->notify = new CallCenterService();
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
        $response = $this->notify->send(env('NOTIFIER_CALL_CENTER_PHONE_TEST'), [
            'body' => '123456'
        ]);

        $data = json_decode($response->getBody()->getContents());

        echo "\n\n" . json_encode($data);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(1, $data->status);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
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
