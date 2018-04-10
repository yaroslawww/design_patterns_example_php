<?php

namespace DesignPatterns\Structural\Facade;


interface NotifiedInterface
{

    public function getRecipient(int $type);

    public function getSubject(int $type);

    public function getContent(int $type);

}