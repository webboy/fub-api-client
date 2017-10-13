<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class NotesTest extends MyTestCase
{
    public function testCreate()
    {
        $client     = new \Webboy\FubApiClient\Endpoints\Notes($this->config);
        $client2    = new Webboy\FubApiClient\Endpoints\People($this->config);

        $list = $client2->index();

        $data['subject']    = 'Note title';
        $data['body']     = 'This is note body';
        $data['personId']    = $list[0]['id'];

        $new_object = $client->create($data);

        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['subject'],$new_object['subject']);
        $this->assertEquals($data['body'],$new_object['body']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Notes($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Notes($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Notes($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $update['subject'] = 'Updated';

        $updated = $client->update($object['id'],$update);

        $this->assertEquals($update['subject'],$updated['subject']);
    }

    public function testRemove()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Notes($this->config);

        $list = $client->index();

        $client->remove($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
    }


}