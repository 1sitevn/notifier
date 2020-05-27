<?php


namespace OneSite\Notifier;


use Twilio\Rest\Client;

/**
 * Class Twilio
 * @package OneSite\Notifier
 */
class Twilio implements Notification
{
    /**
     * @var array|mixed|null
     */
    private $serviceId = null;
    /**
     * @var array|mixed|null
     */
    private $token = null;
    /**
     * @var array|mixed|null
     */
    private $from = null;

    /**
     * @var Config|null
     */
    private $configs = null;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->configs = Config::getInstance();

        $this->serviceId = $this->configs->get('notifier.twilio.id');
        $this->token = $this->configs->get('notifier.twilio.token');
        $this->from = $this->configs->get('notifier.twilio.from');
    }

    /**
     * @param $to
     * @param $data
     * @param array $options
     * @return mixed|\Twilio\Rest\Api\V2010\Account\MessageInstance
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function send($to, $data, $options = [])
    {
        $client = new Client($this->serviceId, $this->token);

        $phone = preg_replace('/^0/', '+84', $to);

        return $client->messages->create(
            $phone,
            [
                'from' => $this->from,
                'body' => !empty($data['message']) ? $data['message'] : ''
            ]
        );
    }

}