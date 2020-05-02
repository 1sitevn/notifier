<?php

namespace OneSite\Notifier;

/**
 * Interface Notification
 * @package OneSite\Notifier
 */
interface Notification
{
    const TYPE_FIREBASE = 'FIREBASE';

    /**
     * @param $title
     * @param $body
     * @param array $options
     * @return mixed
     */
    public function send($title, $body, $options = []);
}