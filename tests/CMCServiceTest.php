<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\CMCService;
use OneSite\Notifier\Services\FirebaseService;
use PHPUnit\Framework\TestCase;

require_once "helpers.php";


/**
 * Class CMCServiceTest
 * @package OneSite\Notifier\Tests
 */
class CMCServiceTest extends TestCase
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

        $this->notify = new CMCService();
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
        $response = $this->notify->send(env('NOTIFIER_CMC_TEST'), [
            'body' => 'Ma xac nhan cua ban la 123456'
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        echo "\n" . json_encode($data);

        $this->assertEquals(1, $data->Code);
    }


    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSendWithUtf8()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_CMC_TEST'), [
            'body' => 'Mã xác nhận của bạn là 123456'
        ], [
            'utf8' => true
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        echo "\n" . json_encode($data);

        $this->assertEquals(1, $data->Code);
    }
}
