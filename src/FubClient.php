<?php

namespace Webboy\FubApiClient;

use Webboy\FubApiClient\FubResponse;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;

class FubClient 
{
	protected $api_key = '';

	protected $http_client;

	protected $api_url = 'https://api.followupboss.com/v1/';

	protected $request_params = array();

	protected $error_message;

	public function __construct()
	{
		$this->api_key = env('FUB_API_KEY',null);

		$this->http_client = new Client(['verify'=>false]);		

		$this->request_params['auth'] = [$this->api_key,''];
	}

	protected function setError($msg)
	{
		$this->error_message = $msg;
	}

	public function getError()
	{
		return $this->error_message;
	}

	protected function request($method,$url,$params=null,$data=null)
	{
		$final_url = $this->api_url.$url;

		if (!empty($params) && is_array($params))
		{
			$this->request_params['query'] = $params;
		}

		if (!empty($data) && is_array($data))
		{
			$this->request_params['form_params'] = $data;
		}

		try
		{
			$response = new FubResponse($this->http_client->request($method,$final_url,$this->request_params));					
			return $response;
			
		} catch (ClientException $e)
		{			
			$response = new FubResponse($e->getResponse());
			return $response;

		} catch (RequestException $e)
		{
			dd($e);
		} catch (\Exception $e) {
			dd($e);
    	}

    	
	}

	public function get($url,$params=null)
	{
		return $this->request('GET',$url,$params);		
	}

	public function post($url,$data=null)
	{
		return $this->request('POST',$url,null,$data);
	}

	public function put($url,$data=null)
	{
		return $this->request('PUT',$url,null,$data);
	}

	protected function respond($response,$index=null)
	{
		if ($response->isSucces())
		{
			if (!empty($index))
			{
				return $response->getData($index);	
			} else {
				return $response->getBody();
			}
		} else {

			$this->setError($response->getErrorMessage());

			return false;
		}
	}
}