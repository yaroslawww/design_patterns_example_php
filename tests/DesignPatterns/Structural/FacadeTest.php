<?php

namespace Tests\DesignPatterns\Structural;


use DesignPatterns\Structural\Facade\NotificationFacade;
use DesignPatterns\Structural\Facade\NotifiedInterface;
use DesignPatterns\Structural\Facade\NotifierInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FacadeTest extends TestCase
{

    public function testNewOrderNotification()
    {
        $email = 'test@email.com';
        $phone = '+112233445566';
        $subject = 'New order submitted';
        $content = 'Order info';

        /*
         *
         * Prepare data
         *
         */

        /** @var NotifiedInterface|MockObject $order */
        $order = $this->createMock(NotifiedInterface::class);

        $order->method('getRecipient')
            ->with($this->logicalOr(
                $this->equalTo(NotifierInterface::TYPE_EMAIL),
                $this->equalTo(NotifierInterface::TYPE_SMS)
            ))
            ->willReturnCallback(function ($type) use ($email, $phone) {
                switch ($type) {
                    case NotifierInterface::TYPE_EMAIL:
                        return $email;
                    case NotifierInterface::TYPE_SMS:
                        return $phone;
                }
                return '';
            });

        $order->method('getSubject')
            ->willReturn($subject);

        $order->method('getContent')
            ->willReturn($content);


        $email_notificator = $this->createMock(NotifierInterface::class);

        $email_notificator->method('getType')
            ->willReturn(NotifierInterface::TYPE_EMAIL);

        $email_notificator->method('notify')
            ->willReturnCallback(function ($to, $subject_actual, $content_actual) use ($email, $subject, $content) {
                $this->assertEquals($email, $to);
                $this->assertEquals($subject, $subject_actual);
                $this->assertEquals($content, $content_actual);
            });


        $sms_notificator = $this->createMock(NotifierInterface::class);

        $sms_notificator->method('getType')
            ->willReturn(NotifierInterface::TYPE_SMS);

        $sms_notificator->method('notify')
            ->willReturnCallback(function ($to, $subject_actual, $content_actual) use ($phone, $subject, $content) {
                $this->assertEquals($phone, $to);
                $this->assertEquals($subject, $subject_actual);
                $this->assertEquals($content, $content_actual);
            });

        /*
        *
        * Run Tests
        *
        */

        $notification_manager = New NotificationFacade($order, [$email_notificator, $sms_notificator]);

        $notification_manager->notify();


    }

}