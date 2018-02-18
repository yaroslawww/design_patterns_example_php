<?php

namespace Tests\DesignPatterns\Creational;


use DesignPatterns\Creational\Builder\ConcreteBuilders\InternalServerErrorResponseBuilder;
use DesignPatterns\Creational\Builder\ConcreteBuilders\SuccessResponseBuilder;
use DesignPatterns\Creational\Builder\ResponseDirector;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{

	protected $response_director;

	public function __construct( string $name = null, array $data = [], string $dataName = '' )
	{
		$this->response_director = new ResponseDirector();
		parent::__construct($name, $data, $dataName);
	}


	public function testSuccessResponse()
	{
		$msg = 'This is Success Response';
		$builder = new SuccessResponseBuilder();
		$builder->setBodyMsg($msg);
		$builder->setBodyData([
			'foo' => 'bar'
		]);
		$builder->setBodyDataItem('other', 'data');
		$response = $this->response_director->build($builder);

		$this->assertEquals(200, $response->getStatus());
		$this->assertEquals('OK', strtoupper($response->getStatusMessage()));
		$data = [
			'foo'   => 'bar',
			'other' => 'data'
		];
		$this->assertSame(array_diff($data, $response->getBody()['data']), array_diff($response->getBody()['data'], $data));
		$this->assertEquals($msg, $response->getBody()['msg']);
	}

	public function testInternalServerErrorResponse()
	{
		$msg = 'Please Contact With Administrator';
		$builder = new InternalServerErrorResponseBuilder();
		$builder->setBodyMsg($msg);
		$response = $this->response_director->build($builder);

		$this->assertEquals($msg, $response->getBody()['msg']);
	}

}