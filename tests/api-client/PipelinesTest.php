<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class PipelinesTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Pipelines($this->config);

        $data['description']    = 'Pipeline description';

        $new_object = $client->create($data);

        $this->assertFalse($new_object);

        $this->assertEquals(400,$client->getHttpResponseCode());

        $data['name']    = 'Pipeline name';

        $new_object = $client->create($data);

        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['description'],$new_object['description']);
        $this->assertEquals($data['name'],$new_object['name']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Pipelines($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Pipelines($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Pipelines($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $update['name'] = 'Disabled';

        $updated = $client->update($object['id'],$update);

        $this->assertEquals($update['name'],$updated['name']);
    }

    public function testRemove()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Pipelines($this->config);

        $list = $client->index();

        $client->remove($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
    }


}