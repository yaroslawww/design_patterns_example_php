<?php

namespace DesignPatterns\Creational\Builder\ConcreteBuilders;


use DesignPatterns\Creational\Builder\BuilderInterface;
use DesignPatterns\Creational\Builder\Response;

abstract class AbstractResponseBuilder implements BuilderInterface
{
	/** @var Response */
	protected $response;
	/** @var int */
	protected $status;
	/** @var string */
	protected $status_message;
	/** @var string */
	protected $body_msg;
	protected $body_data = [];
	protected $body_data_items = [];
	protected $body_errors = [];
	protected $body_additional_items = [];
	protected $body_meta;


	/**
	 * @override
	 */
	public function createResponse()
	{
		$this->response = new Response();
	}

	/**
	 * @override
	 */
	public function addStatus()
	{
		$this->response->setStatus($this->status);
	}

	/**
	 * @override
	 */
	public function addStatusMessage()
	{
		$this->response->setStatusMessage($this->status_message);
	}

	/**
	 * @override
	 */
	public function addBody()
	{
		$this->response->setBody($this->prepareBody());
	}

	/**
	 * @override
	 */
	public function getResponse(): Response
	{
		return $this->response;
	}

	/**
	 * @param mixed $body_msg
	 */
	public function setBodyMsg( $body_msg )
	{
		$this->body_msg = $body_msg;
	}

	/**
	 * @param array $body_data
	 */
	public function setBodyData( array $body_data )
	{
		$this->body_data = $body_data;
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function setBodyDataItem( $key, $value )
	{
		$this->body_data_items[ $key ] = $value;
	}

	/**
	 * @param array $body_errors
	 */
	public function setBodyErrors( array $body_errors )
	{
		$this->body_errors = $body_errors;
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function setBodyAdditionalItem( $key, $value )
	{
		$this->body_additional_items[ $key ] = $value;
	}

	/**
	 * @param mixed $body_meta
	 */
	public function setBodyMeta( $body_meta )
	{
		$this->body_meta = $body_meta;
	}

	/**
	 * Create standard body structure
	 *
	 * @return array
	 */
	protected function prepareBody()
	{
		$body = [];

		if($this->body_msg) {
			$body['msg'] = $this->body_msg;
		}

		if($this->body_data) {
			$data = $this->body_data;
			if(is_array($data) && is_array($this->body_data_items) && count($this->body_data_items)) {
				$data = array_merge($this->body_data_items, $data);
			}
			$body['data'] = $data;
		}

		if(!empty($this->body_errors)) {
			$body['errors'] = $this->body_errors;
		}

		if($this->body_meta) {
			$body['meta'] = $this->body_meta;
		}

		if(is_array($body) && is_array($this->body_additional_items) && count($this->body_additional_items)) {
			$body = array_merge($this->body_additional_items, $body);
		}

		return $body;
	}

}