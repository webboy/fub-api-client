<?php

namespace Webboy\FubApiClient\Endpoints;

use Webboy\FubApiClient\FubClient;

class emCampaigns extends FubClient
{
	protected $endpoint = 'emCampaigns';

	protected $fub_response;

	public function index($params=null)
	{
		$response = $this->get($this->endpoint,$params);

		return $this->respond($response,'emCampaigns');		
	}

	public function show($id)
	{
		$response = $this->get($this->endpoint.'/'.$id);

		return $this->respond($response);		
	}

	public function create($campaign=null)
	{
		$campaign['origin'] = $this->origin;

		$response = $this->post($this->endpoint,$campaign);

		return $this->respond($response);
	}

	public function update($id,$campaign=null)
	{		
		$response = $this->put($this->endpoint.'/'.$id,$campaign);

		return $this->respond($response);
	}
}