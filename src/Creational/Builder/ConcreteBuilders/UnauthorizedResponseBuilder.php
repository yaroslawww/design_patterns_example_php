<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


class UnauthorizedResponseBuilder extends AbstractResponseBuilder
{

	protected $status = 401;
	protected $status_message = 'UNAUTHORIZED';

}