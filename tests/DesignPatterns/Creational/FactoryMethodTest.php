<?php

namespace Tests\DesignPatterns\Creational;


use DesignPatterns\Creational\FactoryMethod\GeneralFormatManager;
use DesignPatterns\Creational\FactoryMethod\JsonParserFormatManager;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{

	protected $data = [
		'foo' => 'bar'
	];

	public function testXmlFormatInGeneral()
	{
		$format = new GeneralFormatManager($this->data);

		$formatted_data = $format->convert('xml');
		$xml            = simplexml_load_string($formatted_data, \SimpleXMLElement::class);

		if($xml != false && isset($xml->foo)) {
			$this->assertEquals('bar', $xml->foo);
		} else {
			$this->fail('Not valid XML');

		}
	}

	public function testJsonFormatInGeneral()
	{
		$format = new GeneralFormatManager($this->data);

		$formatted_data = $format->convert('json');

		$this->assertJson($formatted_data);
		$this->assertEquals(json_encode($this->data), $formatted_data);

	}

	public function testExceptionWhileFormattingInGeneral()
	{
		$format = new GeneralFormatManager($this->data);

		$this->expectException(\Exception::class);

		$format->convert('undefined');
	}

	public function testJsonFormatInJsonParser()
	{
		$format = new JsonParserFormatManager($this->data);

		$formatted_data = $format->convert('json');

		$this->assertJson($formatted_data);
		$this->assertEquals(json_encode($this->data), $formatted_data);

	}

	public function testExceptionWhileFormattingInJsonParser()
	{
		$format = new JsonParserFormatManager($this->data);

		$this->expectException(\Exception::class);

		$format->convert('xml');
	}

}