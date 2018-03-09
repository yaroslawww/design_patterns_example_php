<?php

namespace DesignPatterns\Structural\Bridge\Formats;


interface FormatterInterface
{

	/**
	 * Generate content for file
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	public function convert( array $data ): string;

}