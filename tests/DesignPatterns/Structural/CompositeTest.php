<?php

namespace Tests\DesignPatterns\Structural;


use DesignPatterns\Structural\Composite\MenuItem;
use PHPUnit\Framework\TestCase;

class CompositeTest extends TestCase
{

	public function testMenu()
	{
		$menu = ( new MenuItem() )->makeContainer()
		                          ->addSubItem(new MenuItem('Github', 'https://github.com/'))
		                          ->addSubItem(
			                          ( new MenuItem('Google', 'https://google.com/') )
				                          ->addSubItem(new MenuItem('Analytics', 'https://analytics.google.com/'))
				                          ->addSubItem(new MenuItem('Tagmanager', 'https://tagmanager.google.com'))
		                          );

		$html = $menu->render();

		$this->assertEquals(
			'<ul><li><a href="https://github.com/">Github</a></li><li><a href="https://google.com/">Google</a><ul><li><a href="https://analytics.google.com/">Analytics</a></li><li><a href="https://tagmanager.google.com">Tagmanager</a></li></ul></li></ul>', $html
		);
	}

}