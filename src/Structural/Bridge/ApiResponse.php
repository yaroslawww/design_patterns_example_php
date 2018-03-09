<?php

namespace DesignPatterns\Structural\Bridge;


use DesignPatterns\Structural\Bridge\Formats\FormatterInterface;

class ApiResponse
{

	/**
	 * @var FormatterInterface
	 */
	protected $formatter;

	/**
	 * @param FormatterInterface $format
	 */
	public function __construct( FormatterInterface $format )
	{
		$this->formatter = $format;
	}

	/**
	 * @param FormatterInterface $format
	 */
	public function setImplementation( FormatterInterface $format )
	{
		$this->formatter = $format;
	}

	public function send( array $data )
	{
		return $this->formatter->convert($data);
	}

}