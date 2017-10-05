<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;


use Webboy\FubApiClient\FubClient;

class smartLists extends FubClient
{
    /**
     * @var string $endpoint
     */
    protected $endpoint = 'smartLists';

    /**
     * @param array $query_params
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function index($query_params=array())
    {
        $response = $this->get($this->endpoint,$query_params);

        return $this->respond($response,'smartLists');
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
}