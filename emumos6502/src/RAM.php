<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:51
 */

class RAM
{
    const SIZE = 0x10000;
    const MASK = self::SIZE-1;

    private $mem = [];

    public function __construct()
    {
        $this->mem = array_fill(0,self::SIZE-1,0);

        return $this;
    }
    public function write($addr,$byte)
    {
        $addr &= self::MASK;
        $this->mem[$addr] = $byte;

        return $this;
    }
    public function read($addr)
    {
        $addr &= self::MASK;
        return $this->mem[$addr];
    }
}
