<?php

namespace Tests\DesignPatterns\Structural;


use DesignPatterns\Structural\Bridge\ApiResponse;
use DesignPatterns\Structural\Bridge\Formats\JsonFormatter;
use DesignPatterns\Structural\Bridge\Formats\XmlFormatter;
use PHPUnit\Framework\TestCase;

class BridgeTest extends TestCase
{

	protected $data = [
		'foo' => 'bar'
	];

	public function testXmlFormat()
	{

		$formatted_response = ( new ApiResponse(new XmlFormatter()))->send($this->data);
		$xml            = simplexml_load_string($formatted_response, \SimpleXMLElement::class);

		if($xml != false && isset($xml->foo)) {
			$this->assertEquals('bar', $xml->foo);
		} else {
			$this->fail('Not valid XML');

		}
	}

	public function testJsonFormat()
	{
		$formatted_data = ( new ApiResponse(new JsonFormatter()) )->send($this->data);

		$this->assertJson($formatted_data);
		$this->assertEquals(json_encode($this->data), $formatted_data);

	}

}