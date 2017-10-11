<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class EventsTest extends MyTestCase
{
    public function testBasicTest()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Events($this->config);

        $response = $client->index();

        die('aaaaaaaaaaaaaaaaaa');
    }
}