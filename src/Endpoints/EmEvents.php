<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;

class EmEvents extends Common
{
    /**
     * Stages constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        //Set endpoint and entity index
        $this->setEndpoint('emEvents');
        $this->setEntityIndex('emEvents');

        parent::__construct($config);
    }

    /**
     * @param array $data
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function create($data=array())
    {
        $data['emEvents'] = $data;

        return parent::create($data);
    }
}
