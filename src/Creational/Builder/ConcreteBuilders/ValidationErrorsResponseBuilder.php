<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


class ValidationErrorsResponseBuilder extends AbstractResponseBuilder
{

	protected $status = 409;
	protected $status_message = 'CONFLICT';

}