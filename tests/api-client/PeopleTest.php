<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class PeopleTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $data['firstName']    = 'Nemanja';
        $data['lastName']     = 'Milenkovic';
        $data['emails'][] = 'email01@test.com';
        $data['emails'][] = 'email02@test.com';
        $data['tags'][] = 'Tag 1';
        $data['tags'][] = 'Tag 2';
        $data['background']     = 'Test background string';

        $new_object = $client->create($data);

        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['firstName'],$new_object['firstName']);
        $this->assertEquals($data['lastName'],$new_object['lastName']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $update['firstName'] = 'Updated';

        $updated = $client->update($object['id'],$update);

        $this->assertEquals($update['firstName'],$updated['firstName']);
    }

    public function testRemove()
    {
        $client = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $list = $client->index();

        $client->remove($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
    }


}