<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\SouthTelecomService;
use PHPUnit\Framework\TestCase;


/**
 * Class SouthTelecomServiceTest
 * @package OneSite\Notifier\Tests
 */
class SouthTelecomServiceTest extends TestCase
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

        $this->notify = new SouthTelecomService();
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
        $response = $this->notify->send(env('NOTIFIER_SOUTH_TELECOM_TEST'), [
            'body' => 'Ma xac nhan cua ban la 123456'
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        echo "\n" . json_encode($data);

        $this->assertEquals(1, $data->status);
    }

}
