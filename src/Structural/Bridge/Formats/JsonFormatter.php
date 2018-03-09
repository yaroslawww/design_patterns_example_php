<?php

namespace DesignPatterns\Structural\Bridge\Formats;


class JsonFormatter implements FormatterInterface
{

	/**
	 * Generate content for file
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	public function convert( array $data ): string
	{
		$encoded_data = json_encode($data);

		return $encoded_data?:'{}';
	}
}