<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


class TeapotResponseBuilder extends AbstractResponseBuilder
{

	protected $status = 418;
	protected $status_message = 'I\'M A TEAPOT';

}