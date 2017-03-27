<?php

namespace Webboy\FubApiClient\Endpoints;

use Webboy\FubApiClient\FubClient;

class emEvents extends FubClient
{
	protected $endpoint = 'emEvents';

	protected $fub_response;

	public function index($params=null)
	{
		$response = $this->get($this->endpoint,$params);

		return $this->respond($response,'emEvents');
		
	}

	public function create($events=null)
	{
		$data['emEvents'] = $events;
		$response = $this->post($this->endpoint,$data);

		return $this->respond($response,'emEventIds');
	}
}