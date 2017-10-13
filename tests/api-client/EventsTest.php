<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class EventsTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Events($this->config);

        $data['source'] = 'Webboy Api client';
        $data['system'] = 'Webboy Api client';
        $data['type']   = 'Inquiry';
        $data['person']['firstName']    = 'Nemanja';
        $data['person']['lastName']     = 'Milenkovic';

        $new_object = $client->create($data);

        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['source'],$new_object['source']);
        $this->assertEquals($data['person']['firstName'],$new_object['firstName']);
        $this->assertEquals($data['person']['lastName'],$new_object['lastName']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Events($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Events($this->config);

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }


}