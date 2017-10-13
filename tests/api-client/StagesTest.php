<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class StagesTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Stages($this->config);

        $data['name']    = 'Test stage';

        $new_object = $client->create($data);

        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['name'],$new_object['name']);

        //Create another one
        $data['name'] = 'Another one';
        $client->create($data);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Stages($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Stages($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Stages($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $update['name'] = 'Updated';

        $updated = $client->update($object['id'],$update);

        $this->assertEquals($update['name'],$updated['name']);
    }

    public function testRemove()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Stages($this->config);

        $list = $client->index();

        $data['assignStageId'] = $list[1]['id'];
        $client->remove($list[0]['id'],$data);

        $this->assertEquals(200,$client->getHttpResponseCode());
    }


}