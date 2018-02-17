<?php

namespace DesignPatterns\Creational\AbstractFactory;


use DesignPatterns\Creational\AbstractFactory\Formats\JsonFormatFactory;
use DesignPatterns\Creational\AbstractFactory\Formats\XmlFormatFactory;

class FormatManager
{
	/** @var array $data */
	protected $data;

	/** Singletons formats variables */
	/** @var JsonFormatFactory $json_format */
	private $json_format;
	/** @var XmlFormatFactory $xml_format */
	private $xml_format;

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
	 * @param string $format
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function convert( $format = 'json' )
	{
		switch ( strtolower($format) ) {
			case 'json':
				if(is_null($this->json_format)) {
					$this->json_format = new JsonFormatFactory();
				}

				return $this->json_format->generateContent($this->data);
			case 'xml':
				if(is_null($this->xml_format)) {
					$this->xml_format = new XmlFormatFactory();
				}

				return $this->xml_format->generateContent($this->data);
			default:
				throw new \Exception('Undefined Format');
		}
	}

}