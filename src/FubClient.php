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

	protected $origin;

	public function __construct($config=array())
	{
		if (!empty($config['api_key']))
		{
			$this->api_key = $config['api_key'];
		} else {
			$this->api_key = env('FUB_API_KEY',null);
		}

		if (!empty($config['origin']))
		{
			$this->origin = $config['origin'];
		} else {
			$this->origin = env('FUB_ORIGIN',null);
		}

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

	protected function checkConfig()
	{
		if (empty($this->api_key))
		{
			$this->setError('Follow Up Boss api key is missing.');

			return false;
		}

		if (empty($this->origin))
		{
			$this->setError('Follow Up Boss origin is missing.');

			return false;
		}
	}

	protected function request($method,$url,$params=null,$data=null)
	{

		if ($this->checkConfig() === false)
		{
			return false;
		}

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
		if (is_bool($response))
		{
			return $response;
		}
		
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