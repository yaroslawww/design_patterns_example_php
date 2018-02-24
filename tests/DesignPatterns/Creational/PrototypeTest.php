<?php

namespace Tests\DesignPatterns\Creational;


use DesignPatterns\Creational\Prototype\LoseTicket;
use DesignPatterns\Creational\Prototype\WinTicket;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{

	protected $percent_of_win = 30;

	public function testTickets()
	{

		$lose_ticket = new LoseTicket();
		$win_ticket  = new WinTicket();

		for ( $i = 0; $i < 30; $i ++ ) {
			if($this->percent_of_win <= rand(0, 100)) {
				$ticket = clone $win_ticket;
				$this->assertGreaterThan(0, $ticket->getAmount());
			} else {
				$ticket = clone $lose_ticket;
				$this->assertEquals(0, $ticket->getAmount());
			}
		}

	}

}