<?php

namespace DesignPatterns\Creational\Builder;


interface BuilderInterface
{

	public function createResponse();

	public function addStatus();

	public function addStatusMessage();

	public function addBody();

	public function getResponse(): Response;

}