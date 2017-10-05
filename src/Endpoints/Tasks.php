<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;


use Webboy\FubApiClient\FubClient;

class Tasks extends FubClient
{
    /**
     * @var string $endpoint
     */
    protected $endpoint = 'tasks';

    /**
     * @param array $query_params
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function index($query_params=array())
    {
        $response = $this->get($this->endpoint,$query_params);

        return $this->respond($response,'tasks');
    }

    /**
     * @param array $data
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function create($data=array())
    {
        $response = $this->post($this->endpoint,$data);

        return $this->respond($response);
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
     * @param $id
     * @param array $data
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function update($id,$data=array())
    {
        $response = $this->put($this->endpoint.'/'.$id,$data);

        return $this->respond($response);
    }
}