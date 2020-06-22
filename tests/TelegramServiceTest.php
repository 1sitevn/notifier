<?php


namespace OneSite\Notifier\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\Notifier\Services\TelegramService;
use PHPUnit\Framework\TestCase;

/**
 * Class TelegramServiceTest
 * @package OneSite\Notifier\Tests
 */
class TelegramServiceTest extends TestCase
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

        $this->notify = new TelegramService();
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
     * @throws \Exception
     */
    public function testGetChatBotUrl()
    {
        $data = $this->notify->getChatBotUrl();

        echo "\n" . json_encode($data);

        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testGetUpdates()
    {
        /**
         * @var Response $response
         */
        $response = $this->notify->getUpdates();

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        echo "\n" . json_encode($data);

        $this->assertTrue(true);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSendToDevice()
    {
        $body = "    
ID:      978E69378D
Account: 0332162234
Amount:  497,800đ
Balance: 510,300đ
Date:    2020-04-23 23:04:05
Desc:    Nạp tiền vào tài khoản 0332162234 bằng chuyển khoản (Vietcombank)

Ngân hàng Vietcombank vừa ghi nhận một khoản tiền với thông tin:
Mã chuyển khoản: 9P0000139067
Số tiền: 497.800 VNĐ
Nội dung: MBVCB391813816.9P0000139067.CT tu 0361000357442 LE MINH HAI toi 0011004443823 CT CP 9PAY
Ví nhận tiền: 0332162234
Ngày nhận tiền: 2020-04-24 00:00:00
Trạng thái xử lý: Hệ thống xử lý thành công
Xin cảm ơn!...";

        /**
         * @var Response $response
         */
        $response = $this->notify->send(env('NOTIFIER_TELEGRAM_CHAT_ID'), [
            'body' => $body
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        echo "\n" . json_encode($data);

        $this->assertTrue(true);
    }

}
