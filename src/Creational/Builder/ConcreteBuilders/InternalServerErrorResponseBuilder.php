<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


class InternalServerErrorResponseBuilder extends AbstractResponseBuilder
{

	protected $status = 500;
	protected $status_message = 'INTERNAL SERVER ERROR';

}