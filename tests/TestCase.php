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
        $this->config['api_key']    = '';
        $this->config['origin']     = '';

        parent::__construct($name, $data, $dataName);
    }
}
