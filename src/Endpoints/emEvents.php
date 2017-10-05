<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;

use Webboy\FubApiClient\FubClient;

class emEvents extends FubClient
{
    /**
     * @var string $endpoint
     */
	protected $endpoint = 'emEvents';

    /**
     * @param array $query_params
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
	public function index($query_params=array())
	{
		$response = $this->get($this->endpoint,$query_params);

		return $this->respond($response,'emEvents');
		
	}

    /**
     * @param null $events
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
	public function create($events=null)
	{
		$data['emEvents'] = $events;
		$response = $this->post($this->endpoint,$data);

		return $this->respond($response,'emEventIds');
	}
}