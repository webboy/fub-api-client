<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;

class FubClient 
{
    const VERSION = '1.7';
    /**
     * @var string $api_key
     */
    protected $api_key = '';

    /**
     * @var Client $http_client
     */
	protected $http_client;

    /**
     * @var string $api_url
     */
	protected $api_url = 'https://api.followupboss.com/v1/';

    /**
     * @var array $request_params
     */
	protected $request_params = array();

    /**
     * @var string $error_message
     */
	protected $error_message;

    /**
     * @var string $origin
     */
	protected $origin;

    /**
     * @var string $x_system
     */
	protected $x_system = '';

    /**
     * @var array $meta
     */
    protected $meta = array();

    /**
     * @var Response $http_response;
     */
    protected $http_response;

    /**
     * @var integer $http_response_code
     */
    protected $http_response_code;

    /**
     * FubClient constructor.
     * @param array $config
     */

	public function __construct($config=array())
	{
		if (!empty($config['api_key']))
		{
			$this->api_key = $config['api_key'];
		}

		if (!empty($config['origin']))
		{
			$this->origin = $config['origin'];
		}

		$this->http_client = new Client(['verify'=>false]);		

		$this->request_params['auth'] = [$this->api_key,''];

		//set up headers
        $this->request_params['headers']['User-Agent']  = 'Webboy FUB PHP Client '.self::VERSION;
        $this->request_params['headers']['Accept']      = 'application/json';

	}

    /**
     * @param string $msg
     * @return void
     */

	protected function setError($msg)
	{
		$this->error_message = $msg;
	}

    /**
     * @return string
     */

	public function getError()
	{
		return $this->error_message;
	}

    /**
     * @param string $x_system
     * @return void
     */
	public function setXSystem($x_system='')
    {
        $this->x_system = $x_system;
    }

    /**
     * @return mixed|string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getXSystem()
    {
        return $this->x_system;
    }

    /**
     * @return Response
     */
    public function getHttpResponse()
    {
        return $this->http_response;
    }

    /**
     * @return int
     */
    public function getHttpResponseCode()
    {
        return $this->http_response_code;
    }

    /**
     * @return bool
     */

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

		return true;
	}

    /**
     * @param $method
     * @param $url
     * @param null $params
     * @param null $data
     * @return FubResponse
     */

	protected function request($method,$url,$params=null,$data=null)
	{

		if ($this->checkConfig() === false)
		{
            $response = new Response();

            $this->error_message = 500;
            $this->http_response_code = $this->getError();

            return new FubResponse($response->withStatus(500,$this->getError()));
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

		try {

		    //Check X-System
            if (!empty($this->x_system))
            {
                $this->request_params['headers']['X-System'] = $this->x_system;
            }
            $this->http_response = $this->http_client->request($method, $final_url, $this->request_params);
            $this->http_response_code = $this->http_response->getStatusCode();
            $this->error_message = $this->http_response->getReasonPhrase();
            $response = new FubResponse($this->http_response);
            return $response;
        } catch (ClientException $exception)
        {
            $response = new Response();

            $this->error_message = $exception->getMessage();
            $this->http_response_code = $exception->getCode();

            return new FubResponse($response->withStatus($exception->getCode(),$exception->getMessage()));
        } catch (ConnectException $exception)
        {
            $response = new Response();

            $this->error_message = $exception->getMessage();
            $this->http_response_code = $exception->getCode();

            return new FubResponse($response->withStatus($exception->getCode(),$exception->getMessage()));
        } catch (ServerException $exception)
        {
            $response = new Response();

            $this->error_message = $exception->getMessage();
            $this->http_response_code = $exception->getCode();

            return new FubResponse($response->withStatus($exception->getCode(),$exception->getMessage()));
        }
	}

    /**
     * @param string $url
     * @param array $params
     * @return bool|FubResponse
     */

	public function get($url,$params=array())
	{
		return $this->request('GET',$url,$params);		
	}

    /**
     * @param string $url
     * @param array $data
     * @return bool|FubResponse
     */

	public function post($url,$data=array())
	{
		return $this->request('POST',$url,null,$data);
	}

    /**
     * @param string $url
     * @param array $data
     * @return bool|FubResponse
     */

	public function put($url,$data=array())
	{
		return $this->request('PUT',$url,null,$data);
	}

    /**
     * @param string $url
     * @param array $data
     * @return bool|FubResponse
     */
	public function delete($url,$data=array())
    {
        return $this->request('DELETE',$url,null,$data);
    }

    /**
     * @param FubResponse $response
     * @param null $index
     * @return array|bool
     */
	protected function respond(FubResponse $response,$index=null)
	{
		if ($response->isSucces())
		{
		    $this->meta = $response->getData('_metadata');

			if (!empty($index))
			{
				return $response->getData($index);	
			} else {
				return $response->getBody();
			}
		} else {

			return false;
		}
	}
}