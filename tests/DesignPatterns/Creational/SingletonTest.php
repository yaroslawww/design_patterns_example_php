<?php

namespace Tests\DesignPatterns\Creational;


use DesignPatterns\Creational\Singleton\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{

	public function testSameSingleton()
	{
		$first  = Singleton::getInstance();
		$second = Singleton::getInstance();
		$third  = Singleton::getInstance();

		$this->assertInstanceOf(Singleton::class, $first);
		$this->assertSame($first, $second);
		$this->assertSame($first, $third);
		$this->assertSame($second, $third);
	}

}