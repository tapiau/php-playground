<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:53
 */

class CPU
{
    const VECTOR_NMI = 0xFFFA;
    const VECTOR_RESET = 0xFFFC;
    const VECTOR_IRQ = 0xFFFE;

    /** @var RAM */
    private $ram;

    /* REGISTERS */
    private $A = 0;
    private $X = 0;
    private $Y = 0;
    private $SP = 0x0100;
    private $PC = 0x0000;

    /* FLAGS */
    /** @var bool */
    private $N = false;
    /** @var bool */
    private $V = false;
    /** @var bool */
    private $B = false;
    /** @var bool */
    private $D = false;
    /** @var bool */
    private $I = false;
    /** @var bool */
    private $Z = false;
    /** @var bool */
    private $C = false;

    /* INTERNAL STATUS */
    private $ticks = 0;
    /** @var opCodeList */
    private $opCodeList;

    public function __construct(RAM $ram)
    {
        $this->ram = $ram;
        $this->PC = $this->ram->readWord(CPU::VECTOR_RESET);

        $this->opCodeList = new opCodeList();
    }

    public function reset()
    {
        $this->PC = $this->ram->readWord(CPU::VECTOR_RESET);

        $this->A = 0;
        $this->X = 0;
        $this->SP = 0x0100;

        $this->N = false;
        $this->V = false;
        $this->B = false;
        $this->D = false;
        $this->I = false;
        $this->Z = false;
        $this->C = false;

        $this->ticks = 0;
    }

    public function setPC($address)
    {
        $this->PC = $address & 0xFFFF;
    }
    public function movePC($bytes)
    {
        $this->setPC($this->PC+$bytes);
    }
    public function setSP($address)
    {
        $this->SP = ($address & 0x00FF) + 0x0100;
    }
    public function moveSP($bytes)
    {
        $this->setSP($this->SP+$bytes);
    }

    public function executeOne()
    {
        $this->PC &= 0xFFFF;

        $byte = $this->ram->read($this->PC);

        printr(dechex($byte)." ".$byte);

        $op = $this->opCodeList->decode($byte);

        $this->{$op->call}($op);

    }

    public function getRam()
    {
        return $this->ram;
    }

    public function printRegs()
    {
        printr(
            "A: {$this->A}".PHP_EOL.
            "X: {$this->X}".PHP_EOL.
            "Y: {$this->Y}".PHP_EOL.
            "SP: {$this->SP}".PHP_EOL.
            "PC: {$this->PC}".PHP_EOL.
            "MEM: {$this->ram->read($this->PC)}"
        );
    }

    public function loadRegister(opCode $op)
    {
        $reg = substr($op->mnemonic,-1);

        switch($op->mode)
        {
            case 'imm':
                $value = $this->ram->read($this->PC+1);
                break;
            case 'zp':
                $addr = $this->ram->read($this->PC+1);
                $value = $this->ram->read($addr);
                break;
        }

        $this->{$reg} = $value;

        $this->movePC($op->len);
    }

    public function saveRegister(opCode $op)
    {
        $reg = substr($op->mnemonic,-1);

        switch($op->mode)
        {
            case 'zp':
                $addr = $this->ram->read($this->PC+1);
                break;
        }

        $this->ram->write($addr,$this->{$reg});

        $this->movePC($op->len);
    }
}