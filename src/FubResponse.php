<?php

namespace Webboy\FubApiClient;

class FubResponse
{
	protected $guzzle_response;

	protected $response_body;

	public function __construct($response)
	{
		$this->guzzle_response = $response;
		$this->response_body = @json_decode($response->getBody(),true);
	}

	public function getCode()
	{
		return $this->guzzle_response->getStatusCode();
	}

	public function getMessage()
	{
		return $this->guzzle_response->getReasonPhrase();
	}

	public function getData($index)
	{
		return (!empty($this->response_body[$index]) ? $this->response_body[$index] : null);
	}

	public function getMeta()
	{
		return $this->getData('_metadata');
	}	

	public function getErrorMessage()
	{
		return $this->getData('errorMessage');
	}

	public function getBody()
	{
		return $this->response_body;
	}

	public function isSucces()
	{
		$code = $this->guzzle_response->getStatusCode();

		if ($code == 200)
		{
			return true;
		} else {
			return false;
		}
	}
}