<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:53
 */

class VM
{
    /** @var RAM */
    private $ram;

    /** @var CPU */
    private $cpu;


    public function __construct()
    {
        $this->ram = new RAM();
        $this->cpu = new CPU($this->ram);
    }

    public function loadFileToRam($file,$addr)
    {
        $file = fopen($file,"r");

        while(!feof($file))
        {
            $byte = ord(fread($file,1));

            $this->ram->write($addr,$byte);
            $addr++;
        }

        return $this;
    }

    public function run($pc = null)
    {
        $this->cpu->reset();
        !is_null($pc) && $this->cpu->setPC($pc);

        while(true)
        {
            $this->cpu->executeOne();
            $this->cpu->printRegs();
        }
    }

    public function testSP()
    {
        $this->cpu->setSP(1);
        $this->cpu->printRegs();
        $this->cpu->setSP(257);
        $this->cpu->printRegs();
        $this->cpu->setSP(513);
        $this->cpu->printRegs();
        $this->cpu->setSP(511);
        $this->cpu->printRegs();
        $this->cpu->moveSP(1);
        $this->cpu->printRegs();
    }
}
