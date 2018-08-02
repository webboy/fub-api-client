<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;

class Account extends Common
{
    /**
     * Stages constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        //Set endpoint and entity index
        $this->setEndpoint('account');
        //$this->setEntityIndex('account');

        parent::__construct($config);
    }

    public function account()
    {
        $response = $this->get($this->endpoint);

        return $this->respond($response);
    }
}