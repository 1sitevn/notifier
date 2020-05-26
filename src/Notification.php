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

    /**
     * @param $title
     * @param $body
     * @param array $options
     * @return mixed
     */
    public function send($title, $body, $options = []);
}
