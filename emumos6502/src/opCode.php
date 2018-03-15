<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 22:14
 */

class opCode
{
    public $mnemonic;
    public $call;
    public $mode;
    public $len;
    public $code;

    public function __construct($code,$opCode)
    {
        $this->code = $code;
        foreach($opCode as $key=>$value)
        {
            $this->{$key} = $value;
        }
    }

}
