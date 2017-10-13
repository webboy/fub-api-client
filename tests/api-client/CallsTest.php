<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class CallsTest extends MyTestCase
{
    public function testCreate()
    {
        $client2 = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $data2['firstName']    = 'Nemanja';
        $data2['lastName']     = 'Milenkovic';

        $person = $client2->create($data2);

        $client = new \Webboy\FubApiClient\Endpoints\Calls($this->config);

        $data['note'] = 'Test note';
        $data['phone'] = '123456789';
        $data['outcome'] = 'Interested';
        $data['isIncoming'] = true;
        $data['duration'] = 300;
        $data['personId'] = $person['id'];

        $new_object = $client->create($data);

        $this->assertEquals('Created',$client->getError());
        $this->assertEquals(201,$client->getHttpResponseCode());


        $this->assertEquals($data['note'],$new_object['note']);
        $this->assertEquals($data['phone'],$new_object['phone']);
        $this->assertEquals($data['outcome'],$new_object['outcome']);

    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Calls($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Calls($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }


}