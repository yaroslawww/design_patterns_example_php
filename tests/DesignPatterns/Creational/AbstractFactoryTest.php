<?php

namespace Tests\DesignPatterns\Creational;


use DesignPatterns\Creational\AbstractFactory\Formats\JsonFormatFactory;
use DesignPatterns\Creational\AbstractFactory\Formats\XmlFormatFactory;
use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{

	protected $data = [
		'foo' => 'bar'
	];

	public function testXmlFormat()
	{

		$formatted_data = (new XmlFormatFactory())->generateContent($this->data);
		$xml            = simplexml_load_string($formatted_data, \SimpleXMLElement::class);

		if($xml != false && isset($xml->foo)) {
			$this->assertEquals('bar', $xml->foo);
		} else {
			$this->fail('Not valid XML');

		}
	}

	public function testJsonFormat()
	{
		$formatted_data = (new JsonFormatFactory())->generateContent($this->data);

		$this->assertJson($formatted_data);
		$this->assertEquals(json_encode($this->data), $formatted_data);

	}

}