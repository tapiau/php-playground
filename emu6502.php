<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:57
 */

require_once('src/func.php');

$vm = new VM();
$vm->loadFileToRam($argv[1],0xc000);

$vm->run(0xc000);
