<?php

namespace DesignPatterns\Structural\Facade;

/**
 * Class NotificationManager (Example Facade)
 * @package DesignPatterns\Structural\Facade
 */
class NotificationFacade
{

    protected $notified;
    protected $notifiers = [];

    /**
     * NotificationFacade constructor.
     * @param NotifiedInterface $notified
     * @param NotifierInterface[] $notifiers
     */
    public function __construct(NotifiedInterface $notified, $notifiers)
    {
        $this->notified = $notified;
        $this->notifiers = $notifiers;
    }

    public function notify()
    {
        /** @var NotifierInterface $notifier */
        foreach ($this->notifiers as $notifier) {
            $type = $notifier->getType();
            $notifier->notify(
                $this->notified->getRecipient($type),
                $this->notified->getSubject($type),
                $this->notified->getContent($type)
            );
        }
    }

}