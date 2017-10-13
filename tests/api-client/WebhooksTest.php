<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class WebhooksTest extends MyTestCase
{
    public function testCreate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Webhooks($this->config);

        $client->setXSystem('Webboy');

        $data['event']    = 'peopleCreated';

        $new_object = $client->create($data);

        $this->assertFalse($new_object);

        $this->assertEquals(400,$client->getHttpResponseCode());

        $data['url']    = 'https://acmeLeadProvider.com/callbacks/peopleCreated';

        $new_object = $client->create($data);

        $this->assertEquals(201,$client->getHttpResponseCode());

        $this->assertEquals($data['event'],$new_object['event']);
        $this->assertEquals($data['url'],$new_object['url']);
    }

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Webhooks($this->config);

        $client->setXSystem('Webboy');

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }

    public function testShow()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Webhooks($this->config);

        $client->setXSystem('Webboy');

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
        $this->assertEquals($object['id'],$list[0]['id']);
    }

    public function testUpdate()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Webhooks($this->config);

        $client->setXSystem('Webboy');

        $list = $client->index();

        $object = $client->show($list[0]['id']);

        $update['status'] = 'Disabled';

        $updated = $client->update($object['id'],$update);

        $this->assertEquals($update['status'],$updated['status']);
    }

    public function testRemove()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Webhooks($this->config);

        $client->setXSystem('Webboy');

        $list = $client->index();

        $client->remove($list[0]['id']);

        $this->assertEquals(200,$client->getHttpResponseCode());
    }


}