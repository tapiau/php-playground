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
            'mnemonic'=>'vm_LDA_imm',
            'len'=>2
        ],
        0xA2=>[
            'mnemonic'=>'vm_LDX_imm',
            'len'=>2
        ],
        0xA0=>[
            'mnemonic'=>'vm_LDY_imm',
            'len'=>2
        ],
        0xA5=>[
            'mnemonic'=>'>vm_LDA_zp',
            'len'=>2
        ],
        0xA6=>[
            'mnemonic'=>'vm_LDX_zp',
            'len'=>2
        ],
        0xA4=>[
            'mnemonic'=>'vm_LDY_zp',
            'len'=>2
        ],
        0x85=>[
            'mnemonic'=>'vm_STA_z',
            'len'=>2
        ],
        0x86=>[
            'mnemonic'=>'vm_STX_z',
            'len'=>2
        ],
        0x84=>[
            'mnemonic'=>'vm_STY_z',
            'len'=>2
        ]
    ];
}
