#!php
<?php
/**
 * Created by PhpStorm.
 * User: goha
 * Date: 08.03.2018
 * Time: 20:57
 */

require_once('src/func.php');

$input = new Input();

$sampleList = new SampleList(1000,0,1,$input);

$fft = new FFT($sampleList);

for($freq=0;$freq<6;$freq+=0.1)
{
	echo "$freq :: ".$fft->calcWeight($freq).PHP_EOL;
}

