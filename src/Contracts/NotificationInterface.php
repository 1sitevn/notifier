<?php

namespace OneSite\Notifier\Contracts;

/**
 * Interface NotificationInterface
 * @package OneSite\Notifier\Contracts
 */
interface NotificationInterface
{
    const TYPE_FIREBASE = 'FIREBASE';
    const TYPE_CALL_CENTER = 'CALL_CENTER';
    const TYPE_TWILIO = 'TWILIO';
    const TYPE_FUNTAP = 'FUNTAP';


    /**
     * @param $to
     * @param $data
     * @param array $options
     * @return mixed
     */
    public function send($to, $data, $options = []);
}
