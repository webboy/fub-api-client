<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class EmCampaignsTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\EmCampaigns($this->config);

        $data['originId']    = rand(1,10000);
        $data['name']     = 'Test campaign';
        $data['subject']   = 'Test subject';
        $data['bodyHtml']  = 'test body';


        $campaign = $client->create($data);

        $this->assertEquals('Created',$client->getError());
        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($campaign['name'],$data['name']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\EmCampaigns($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\EmCampaigns($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $update['name'] = 'Updated';

        $updated = $client->update($object['id'],$update);

        $this->assertEquals($update['name'],$updated['name']);
    }
}