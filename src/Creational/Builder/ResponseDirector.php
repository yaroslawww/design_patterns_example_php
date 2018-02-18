<?php

namespace DesignPatterns\Creational\Builder;


class ResponseDirector
{

	/**
	 * Build response object
	 *
	 * @param BuilderInterface $builder
	 *
	 * @return Response
	 */
	public function build( BuilderInterface $builder ): Response
	{
		$builder->createResponse();

		$builder->addStatus();
		$builder->addStatusMessage();
		$builder->addBody();

		return $builder->getResponse();
	}

}