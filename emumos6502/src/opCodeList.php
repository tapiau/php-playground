<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 22:14
 */

class opCodeList
{
    private $map = [
        0xA9=>[
            'mnemonic'=>'LDA',
            'call'=>'loadRegister',
            'mode'=>'imm',
            'len'=>2
        ],
        0xA2=>[
            'mnemonic'=>'LDX',
            'call'=>'loadRegister',
            'mode'=>'imm',
            'len'=>2
        ],
        0xA0=>[
            'mnemonic'=>'LDY',
            'call'=>'loadRegister',
            'mode'=>'imm',
            'len'=>2
        ],
        0xA5=>[
            'mnemonic'=>'LDA',
            'call'=>'loadRegister',
            'mode'=>'zp',
            'len'=>2
        ],
        0xA6=>[
            'mnemonic'=>'LDX',
            'call'=>'loadRegister',
            'mode'=>'zp',
            'len'=>2
        ],
        0xA4=>[
            'mnemonic'=>'LDY',
            'call'=>'loadRegister',
            'mode'=>'zp',
            'len'=>2
        ],
        0x85=>[
            'mnemonic'=>'STA',
            'call'=>'saveRegister',
            'mode'=>'zp',
            'len'=>2
        ],
        0x86=>[
            'mnemonic'=>'STX',
            'call'=>'saveRegister',
            'mode'=>'zp',
            'len'=>2
        ],
        0x84=>[
            'mnemonic'=>'STY',
            'call'=>'saveRegister',
            'mode'=>'zp',
            'len'=>2
        ]
    ];

    public function decode($opCode)
    {
        if(!array_key_exists($opCode,$this->map))
        {
            throw new Exception("NONEXISTENT OPCODE!");
        }

        return new opCode($opCode,$this->map[$opCode]);
    }
}
