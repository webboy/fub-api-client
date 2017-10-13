<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class EmEventsTest extends MyTestCase
{
    public function testCreate()
    {
        $client3 = new \Webboy\FubApiClient\Endpoints\People($this->config);

        $data3['firstName']    = 'Nemanja';
        $data3['lastName']     = 'Milenkovic';
        $data3['emails'][] = 'email01@test.com';
        $data3['emails'][] = 'email02@test.com';
        $data3['tags'][] = 'Tag 1';
        $data3['tags'][] = 'Tag 2';
        $data3['background']     = 'Test background string';

        $person = $client3->create($data3);

        $this->assertEquals('Created',$client3->getError());
        $this->assertEquals(201,$client3->getHttpResponseCode());

        $client2 = new \Webboy\FubApiClient\Endpoints\EmCampaigns($this->config);

        $data2['originId']    = rand(1,10000);
        $data2['name']     = 'Test campaign';
        $data2['subject']   = 'Test subject';
        $data2['bodyHtml']  = 'test body';


        $campaign = $client2->create($data2);

        $this->assertEquals('Created',$client2->getError());
        $this->assertEquals(201,$client2->getHttpResponseCode());

        $this->assertEquals($campaign['name'],$data2['name']);

        $client = new \Webboy\FubApiClient\Endpoints\EmEvents($this->config);

        $data[0]['type'] = 'delivered';
        $data[0]['occurred'] = '2017-04-09T16:10:59Z';
        $data[0]['outcome'] = 'Interested';
        $data[0]['recipient'] = 'extramedia.nemanja@gmail.com';
        $data[0]['userId'] = $person['id'];
        $data[0]['campaignId'] = $campaign['id'];

        $response = $client->create($data);

        $this->assertEquals('OK',$client->getError());
        $this->assertEquals(200,$client->getHttpResponseCode());
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\EmEvents($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }
}