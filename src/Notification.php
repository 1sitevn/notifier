<?php

namespace OneSite\Notifier;

/**
 * Interface Notification
 * @package OneSite\Notifier
 */
interface Notification
{
    /**
     * @param $title
     * @param $body
     * @param array $options
     * @return mixed
     */
    public function send($title, $body, $options = []);
}