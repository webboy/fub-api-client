<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class ActionPlansPeopleTest extends MyTestCase
{
    public function testCreate()
    {
        $client     = new \Webboy\FubApiClient\Endpoints\ActionPlansPeople($this->config);
        $client2    = new Webboy\FubApiClient\Endpoints\People($this->config);
        $client3    = new \Webboy\FubApiClient\Endpoints\ActionPlans($this->config);

        $list = $client2->index();
        $list2 = $client3->index();


        $data['actionPlanId']     = $list2[0]['id'];
        $data['personId']         = $list[0]['id'];

        $client->create($data);

        if ($client->getHttpResponseCode()== 400)
        {
            $this->assertEquals(400,$client->getHttpResponseCode());
        } else {

            $this->assertEquals('Created', $client->getError());
            $this->assertEquals(201, $client->getHttpResponseCode());
        }
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\ActionPlansPeople($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\ActionPlansPeople($this->config);

        $list = $client->index();

        $update['status'] = 'Paused';

        $updated = $client->update($list[0]['id'],$update);

        $this->assertEquals($update['status'],$updated['status']);
    }
}