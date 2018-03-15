<?php
/**
 * Created by PhpStorm.
 * User: zibi
 * Date: 2018-03-13
 * Time: 12:30
 */

class Input
{
		public function sample($time)
	{
		$arc = self::timeToRadians($time);

		return cos(3*$arc)+cos(4*$arc)+2;
//		return cos(3*$arc)+1;
	}

	public static function timeToRadians($time)
	{
		return $time*2*M_PI;
	}

	public function sampleList($sampleRate,$timeStart,$timeLen)
	{
		$sampleList = [];

		$sampleCount = $sampleRate*$timeLen;

		for($sampleCounter=0;$sampleCounter<$sampleCount;$sampleCounter++)
		{
			$sampleList[] = $this->sample($timeStart + $sampleCounter/$sampleRate);
		}


		return $sampleList;
	}
}
