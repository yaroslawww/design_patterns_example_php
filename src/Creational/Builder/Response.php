<?php

namespace DesignPatterns\Creational\Builder;


class Response
{

	/** @var int  */
	protected $status = 200;
	/** @var string  */
	protected $status_message = 'OK';
	/** @var array  */
	protected $body = [];

	/**
	 * @return int
	 */
	public function getStatus(): int
	{
		return $this->status;
	}

	/**
	 * @param int $status
	 */
	public function setStatus( int $status )
	{
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getStatusMessage(): string
	{
		return $this->status_message;
	}

	/**
	 * @param string $status_message
	 */
	public function setStatusMessage( string $status_message )
	{
		$this->status_message = $status_message;
	}

	/**
	 * @return array
	 */
	public function getBody(): array
	{
		return $this->body;
	}

	/**
	 * @param array $body
	 */
	public function setBody( array $body )
	{
		$this->body = $body;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return json_encode([
			'status'  => $this->status,
			'message' => $this->status,
			'body'    => $this->body
		]);
	}

}