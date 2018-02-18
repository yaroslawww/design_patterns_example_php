<?php

namespace Tests\DesignPatterns\Creational;


use DesignPatterns\Creational\FactoryMethod\FormatManager;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{

	protected $data = [
		'foo' => 'bar'
	];

	public function testXmlFormat()
	{
		$format = new FormatManager($this->data);

		$formatted_data = $format->convert('xml');
		$xml            = simplexml_load_string($formatted_data, \SimpleXMLElement::class);

		if($xml != false && isset($xml->foo)) {
			$this->assertEquals('bar', $xml->foo);
		} else {
			$this->fail('Not valid XML');

		}
	}

	public function testJsonFormat()
	{
		$format = new FormatManager($this->data);

		$formatted_data = $format->convert('json');

		$this->assertJson($formatted_data);
		$this->assertEquals(json_encode($this->data), $formatted_data);

	}

	public function testExceptionWhileFormatting()
	{
		$format = new FormatManager($this->data);

		$this->expectException(\Exception::class);

		$format->convert('undefined');
	}

}