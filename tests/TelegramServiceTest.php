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
⌛️ #pending 🦅 #deposit #978E69378D #0332162234

<code>OrderID: </code> 978E69378D
<code>Account: </code> 0332162234
<code>Desc:    </code> Nạp tiền vào tài khoản 0332162234 bằng chuyển khoản (Vietcombank)
<code>Amount:  </code> 497,800đ
🤩";

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
