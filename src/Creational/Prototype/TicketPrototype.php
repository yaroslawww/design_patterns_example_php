<?php

namespace DesignPatterns\Creational\Prototype;


abstract class TicketPrototype
{
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var int
	 */
	protected $amount = 0;

	/**
	 * @var string
	 */
	protected $main_color;

	/**
	 * @var string
	 */
	protected $second_color;

	/**
	 * @var int
	 */
	protected $width;

	/**
	 * @var int
	 */
	protected $height;

	abstract public function __clone();

	/**
	 * @return int
	 */
	public function getAmount(): int
	{
		return $this->amount;
	}


}