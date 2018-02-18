<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


class SuccessResponseBuilder extends AbstractResponseBuilder
{

	protected $status = 200;
	protected $status_message = 'OK';

}