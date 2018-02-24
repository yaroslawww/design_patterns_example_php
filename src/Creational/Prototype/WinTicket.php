<?php

namespace DesignPatterns\Creational\Prototype;


class WinTicket extends TicketPrototype
{

	/**
	 * @var int
	 */
	protected $min_amount = 0;

	/**
	 * @var int
	 */
	protected $max_amount = 0;


	public function __construct()
	{
		$data = json_decode(file_get_contents(__DIR__ . '/tickets_configurations/win_tickets_configuration.json'), true);

		$this->title        = 'You are win!';
		$this->min_amount   = ( isset($data['amount']['min']) ) ? $data['amount']['min'] : 0;
		$this->max_amount   = ( isset($data['amount']['max']) ) ? $data['amount']['max'] : 0;
		$this->main_color   = ( isset($data['colors']['main']) ) ? $data['colors']['main'] : '#FFFFFF';
		$this->second_color = ( isset($data['colors']['second']) ) ? $data['colors']['second'] : '#FFFFFF';
		$this->height       = ( isset($data['size']['height']) ) ? $data['size']['height'] : 100;
		$this->width        = ( isset($data['size']['width']) ) ? $data['size']['width'] : 100;

		$this->generateAmount();

	}

	public function __clone()
	{
		$this->generateAmount();
	}

	protected function generateAmount()
	{
		$this->amount = rand($this->min_amount, $this->max_amount);
	}
}