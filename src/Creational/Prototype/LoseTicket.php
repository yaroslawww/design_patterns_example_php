<?php

namespace DesignPatterns\Creational\Prototype;


class LoseTicket extends TicketPrototype
{

	public function __construct()
	{
		$data = json_decode(file_get_contents(__DIR__ . '/tickets_configurations/lose_tickets_configuration.json'), true);

		$this->title        = 'You are lose!';
		$this->amount       = 0;
		$this->main_color   = ( isset($data['colors']['main']) ) ? $data['colors']['main'] : '#FFFFFF';
		$this->second_color = ( isset($data['colors']['second']) ) ? $data['colors']['second'] : '#FFFFFF';
		$this->height       = ( isset($data['size']['height']) ) ? $data['size']['height'] : 100;
		$this->width        = ( isset($data['size']['width']) ) ? $data['size']['width'] : 100;

	}

	public function __clone()
	{
		//
	}

}