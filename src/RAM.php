<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:51
 */

class RAM
{
    private $mem = [];

    public function __construct()
    {
        $this->mem = array_fill(0,65535,0);

        return $this;
    }
    public function write($addr,$b)
    {
        $addr &= 0xFFFF;

        $this->mem[$addr] = $b;

        return $this;
    }
    public function read($addr)
    {
        $addr &= 0xFFFF;
        return $this->mem[$addr];
    }
}