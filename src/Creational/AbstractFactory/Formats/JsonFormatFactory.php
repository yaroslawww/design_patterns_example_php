<?php

namespace DesignPatterns\Creational\AbstractFactory\Formats;


use DesignPatterns\Creational\AbstractFactory\AbstractFormatFactory;

class JsonFormatFactory extends AbstractFormatFactory
{

	public function generateContent( array $data ): string
	{
		$encoded_data = json_encode($data);
		return $encoded_data?:'{}';
	}
}