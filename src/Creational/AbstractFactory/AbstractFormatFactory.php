<?php


namespace DesignPatterns\Creational\AbstractFactory;


abstract class AbstractFormatFactory
{
	/**
	 * Generate content for file
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	abstract public function generateContent( array $data ): string;
}