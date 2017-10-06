<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;


class Stages extends Common
{
    /**
     * Stages constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        //Set endpoint and entity index
        $this->setEndpoint('stages');
        $this->setEntityIndex('stages');

        parent::__construct($config);
    }
}