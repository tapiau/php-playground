<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:57
 */

require_once('src/func.php');

$vm = new VM();
$vm->loadFileToRam($argv[1],0xC000);

$vm->run(0xC000);
