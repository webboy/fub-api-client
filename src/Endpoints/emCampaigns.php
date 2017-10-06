<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;

use Webboy\FubApiClient\FubClient;

class EmCampaigns extends FubClient
{
    /**
     * @var string $endpoint
     */
	protected $endpoint = 'emCampaigns';

    /**
     * @param array $query_params
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
	public function index($query_params=array())
	{
		$response = $this->get($this->endpoint,$query_params);

		return $this->respond($response,'emCampaigns');		
	}

    /**
     * @param $id
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
	public function show($id)
	{
		$response = $this->get($this->endpoint.'/'.$id);

		return $this->respond($response);		
	}

    /**
     * @param null $campaign
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
	public function create($campaign=null)
	{
		$campaign['origin'] = $this->origin;

		$response = $this->post($this->endpoint,$campaign);

		return $this->respond($response);
	}

    /**
     * @param $id
     * @param null $campaign
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
	public function update($id,$campaign=null)
	{		
		$response = $this->put($this->endpoint.'/'.$id,$campaign);

		return $this->respond($response);
	}
}