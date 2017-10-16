<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class DealsTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Stages($this->config);

        $data_stage['name']    = 'Test stage';

        $stage = $client->create($data_stage);

        $client = new \Webboy\FubApiClient\Endpoints\Deals($this->config);

        $data['description']    = 'Deal description';

        $new_object = $client->create($data);

        $this->assertFalse($new_object);

        $this->assertEquals(400,$client->getHttpResponseCode());

        $client2 = new \Webboy\FubApiClient\Endpoints\Pipelines($this->config);

        $data_pipeline['name']    = 'Pipeline name';
        $data_pipeline['description']    = 'Pipeline description';
        $data_pipeline['stages'][] = $data_stage;

        $client2->create($data_pipeline);

        $data['name']    = 'Deal name';
        $data['stageId']    = $stage['id'];

        $new_object = $client->create($data);

        $this->assertEquals('Created',$client->getError());
        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['description'],$new_object['description']);
        $this->assertEquals($data['name'],$new_object['name']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Deals($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Deals($this->config);

        $list = $client->index();

        if (!empty($list[0]['id'])) {

            $object = $client->show($list[0]['id']);

            $this->assertEquals(200, $client->getHttpResponseCode());
            $this->assertEquals($object['id'], $list[0]['id']);
        }
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Deals($this->config);

        $list = $client->index();

        if (!empty($list[0]['id'])) {
            $object = $client->show($list[0]['id']);

            $update['name'] = 'Updated';

            $updated = $client->update($object['id'], $update);

            $this->assertEquals($update['name'], $updated['name']);
        }
    }

    public function testRemove()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Deals($this->config);

        $list = $client->index();

        if (!empty($list[0]['id'])) {
            $client->remove($list[0]['id']);

            $this->assertEquals(200, $client->getHttpResponseCode());
        }
    }


}