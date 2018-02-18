<?php

namespace DesignPatterns\Creational\FactoryMethod;


use DesignPatterns\Creational\AbstractFactory\Formats\JsonFormatFactory;

class JsonParserFormatManager implements FormatFactoryMethodInterface
{
	/** @var array $data */
	protected $data;

	/** Singletons formats variables */
	/** @var JsonFormatFactory $json_format */
	private $json_format;

	/**
	 * FileManager constructor.
	 *
	 * @param array $data
	 */
	public function __construct( array $data = [] )
	{
		$this->data = $data;
	}

	/**
	 * This Is Factory Method for Formats Factory
	 *
	 * @param string $format
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function convert( $format = 'json' ): string
	{
		switch ( strtolower($format) ) {
			case 'json':
				if(is_null($this->json_format)) {
					$this->json_format = new JsonFormatFactory();
				}

				return $this->json_format->generateContent($this->data);
			default:
				throw new \Exception('Undefined Format');
		}
	}

}