<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 10/11/2017
 * Time: 4:18 PM
 */

use PHPUnit\Framework\TestCase;

class MyTestCase extends TestCase
{
    /**
     * @var array $config
     */
    public $config = array();

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->config['api_key']    = $_SERVER['FUB_API_KEY'];
        $this->config['origin']     = $_SERVER['FUB_ORIGIN'];

        parent::__construct($name, $data, $dataName);
    }
    /**
     * @param $value
     * @return void
     */
    public function write($value){
        fwrite(STDERR, print_r($value, TRUE));
    }

}
