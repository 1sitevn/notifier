<?php

namespace OneSite\Notifier;

/**
 * Interface Notification
 * @package OneSite\Notifier
 */
interface Notification
{
    const TYPE_FIREBASE = 'FIREBASE';
    const TYPE_CALL_CENTER = 'CALL_CENTER';
    const TYPE_TWILIO = 'TWILIO';


    /**
     * @param $to
     * @param $data
     * @param array $options
     * @return mixed
     */
    public function send($to, $data, $options = []);
}
