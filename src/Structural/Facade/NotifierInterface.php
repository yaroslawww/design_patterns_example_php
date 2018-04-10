<?php

namespace DesignPatterns\Structural\Facade;


interface NotifierInterface
{
    const TYPE_EMAIL = 1;
    const TYPE_SMS = 2;
    const TYPE_DB = 3;
    const TYPE_TWITTER = 4;

    /**
     * @return int
     */
    public function getType();

    public function notify($to, $subject, $content);

}