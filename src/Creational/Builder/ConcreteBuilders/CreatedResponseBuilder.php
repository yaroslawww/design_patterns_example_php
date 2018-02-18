<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


class CreatedResponseBuilder extends AbstractResponseBuilder
{

	protected $status = 201;
	protected $status_message = 'CREATED';

}