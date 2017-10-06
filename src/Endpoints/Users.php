<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;


class Users extends Common
{
    /**
     * Stages constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        //Set endpoint and entity index
        $this->setEndpoint('users');
        $this->setEntityIndex('users');

        parent::__construct($config);
    }

    /**
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function me()
    {
        $response = $this->get('me');

        return $this->respond($response);
    }
}