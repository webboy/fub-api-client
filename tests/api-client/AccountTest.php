<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:32 PM
 */

class AccountTest extends MyTestCase
{
    public function testAccount()
    {
        $client = new \Webboy\FubApiClient\Endpoints\Account($this->config);

        $account = $client->account();

        $this->assertEquals('godzilla',$account['nameKey']);

        $this->assertEquals(200,$client->getHttpResponseCode());
    }
}