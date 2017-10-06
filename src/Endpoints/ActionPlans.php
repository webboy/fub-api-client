<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/5/2017
 * Time: 4:31 PM
 */

namespace Webboy\FubApiClient\Endpoints;




class ActionPlans extends Common
{
    /**
     * Stages constructor.
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        //Set endpoint and entity index
        $this->setEndpoint('actionPlans');
        $this->setEntityIndex('actionPlans');

        parent::__construct($config);
    }

    /**
     * @param array $query_params
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function people($query_params=array())
    {
        $response = $this->get($this->endpoint.'People',$query_params);

        return $this->respond($response,'actionPlansPeople');
    }

    /**
     * @param array $data
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function create($data=array())
    {
        $response = $this->post($this->endpoint.'People',$data);

        return $this->respond($response);
    }


    /**
     * @param $id
     * @param array $data
     * @return bool|mixed|null|\Webboy\FubApiClient\FubResponse
     */
    public function update($id,$data=array())
    {
        $response = $this->put($this->endpoint.'People/'.$id,$data);

        return $this->respond($response);
    }
}
