<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:53
 */

class VM
{
    private $a = 0;
    private $x = 0;
    private $y = 0;
    private $sp = 0x0100;
    private $px = 0x0000;
    /** @var RAM */
    private $ram;


    public function __construct()
    {
        $this->ram = new RAM();
    }

    public function executeOne()
    {
        $this->pc &= 0xFFFF;

        $opCode = ord($this->ram->read($this->pc));

        switch($opCode)
        {
            case 0xA9:
                    $this->vm_LDA_imm($this->ram->read($this->pc+1));
                    break;
            case 0xA2:
                $this->vm_LDX_imm($this->ram->read($this->pc+1));
                break;
            case 0xA0:
                $this->vm_LDY_imm($this->ram->read($this->pc+1));
                break;

            case 0xA5:
                $this->vm_LDA_zp($this->ram->read($this->pc+1));
                break;
            case 0xA6:
                $this->vm_LDX_zp($this->ram->read($this->pc+1));
                break;
            case 0xA4:
                $this->vm_LDY_zp($this->ram->read($this->pc+1));
                break;

            case 0x85:
                $this->vm_STA_zp($this->ram->read($this->pc+1));
                break;
            case 0x86:
                $this->vm_STX_zp($this->ram->read($this->pc+1));
                break;
            case 0x84:
                $this->vm_STY_zp($this->ram->read($this->pc+1));
                break;
            default:
                $this->printRegs();
                throw new Exception('NON EXISTENT OPCODE');
        }
    }

    public function loadFileToRam($file,$addr)
    {
        $file = fopen($file,"r");

        while(!feof($file))
        {
            $byte = fread($file,1);

            $this->ram->write($addr,$byte);
            $addr++;
        }

        return $this;
    }

    public function loadToRam($addr,$data)
    {
        $arr = str_split($data);
        $len = count($data);

        for($i=0;$i<$len;$i++)
        {
            $this->ram->write($addr+$i,$arr[$i]);
        }

        return $this;
    }

    public function run($pc)
    {
        $this->pc = $pc;

        while(true)
        {
            $this->executeOne();
            $this->printRegs();
        }
    }

    public function printRegs()
    {
        printr(
            "A: {$this->a}".PHP_EOL.
            "X: {$this->x}".PHP_EOL.
            "Y: {$this->y}".PHP_EOL.
            "SP: {$this->sp}".PHP_EOL.
            "PC: {$this->pc}".PHP_EOL.
            "MEM: {$this->ram->read($this->pc)}"
        );
    }


    public function vm_LDA_imm($arg)
    {
        $this->a = $arg;
        $this->pc += 2;

        return $this;
    }
    public function vm_LDX_imm($arg)
    {
        $this->x = $arg;
        $this->pc += 2;

        return $this;
    }
    public function vm_LDY_imm($arg)
    {
        $this->y = $arg;
        $this->pc += 2;

        return $this;
    }
    
    public function vm_LDA_zp($addr)
    {
        $this->a = $this->ram->read($addr);
        $this->pc += 2;

        return $this;
    }
    public function vm_LDX_zp($addr)
    {
        $this->x = $this->ram->read($addr);
        $this->pc += 2;

        return $this;
    }
    public function vm_LDY_zp($addr)
    {
        $this->y = $this->ram->read($addr);
        $this->pc += 2;

        return $this;
    }

    public function vm_STA_zp($addr)
    {
        $this->ram->write($addr,$this->a);
        $this->pc += 2;

        return $this;
    }
    public function vm_STX_zp($addr)
    {
        $this->ram->write($addr,$this->x);
        $this->pc += 2;

        return $this;
    }
    public function vm_STY_zp($addr)
    {
        $this->ram->write($addr,$this->y);
        $this->pc += 2;

        return $this;
    }

}