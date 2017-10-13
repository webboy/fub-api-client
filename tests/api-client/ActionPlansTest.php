<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class ActionPlansTest extends MyTestCase
{

    public function testIndex()
    {
        $client = new \Webboy\FubApiClient\Endpoints\ActionPlans($this->config);

        $list = $client->index();

        $this->assertEquals(200,$client->getHttpResponseCode());

        $this->assertGreaterThan(0,count($list));
    }
}