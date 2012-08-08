<?php
	function lunar_date($format_string, $time = null)
	{
		/**
		  * A simple function to calculate the Lunar Standard Time
		  *
		  * Gabor Heja (gheja) http://github.com/gheja/lunar_date, 2011-2012
		  *
		  * This code is free, redistribute and/or modify under the terms of
		  * GPL v3 or later. See http://www.gnu.org/licenses/gpl.html
		  *
		  * Lunar epoch is 1969-07-21 02:56:15 UTC (-14159025 in Unix Time)
		  *
		  * 1 Lunar second is 0.9843529666671 second on Earth
		  * 1 Lunar minute is 60 Lunar seconds
		  * 1 Lunar hour is 60 Lunar minutes
		  * 1 Lunar cycle is 24 Lunar hours
		  * 1 Lunar day is 30 Lunar cycles
		  * 1 Lunar year is 12 Lunar days
		  *
		  * The days are named after the twelve men who walked on the Moon.
		  *
		  * The specified separator is one of the following:
		  *   ▽ (html code &#9661;, and Unicode 25BD)
		  *   ∇ (html code &nabla;, and Unicode 2207)
		  *   V (capital latin V letter)
		  *
		  * For more info see http://lunarclock.org/
		  **/
		
		if ($time == null)
		{
			$time = time();
		}
		
		$unix_seconds_since_lunar_epoch = $time + 14159025;
		$lunar_time = (int) ($unix_seconds_since_lunar_epoch / 0.984352966667);
		
		$years = floor($lunar_time / (31104000)) + 1;
		$days = floor($lunar_time % (31104000) / (30*24*60*60)) + 1;
		$cycles = floor($lunar_time % (30*24*60*60) / (24*60*60)) + 1;
		$hours = floor($lunar_time % (24*60*60) / 3600);
		$minutes = floor($lunar_time % (60*60) / 60);
		$seconds = floor($lunar_time % (60));

		$lunar_day_names = array(
			"Armstrong", "Aldrin", "Conrad", "Bean", "Shepard", "Mitchell",
			"Scott", "Irwin", "Young", "Duke", "Cernan", "Schmitt"
		);
		
		$array = array(
			"s" => $lunar_time,
			"y" => $years,
			"j" => $days,
			"c" => $cycles,
			"G" => $hours,
			"n" => $minutes,
//			"?" => $seconds,
			"Y" => sprintf("%02d", $years),
			"d" => sprintf("%02d", $days),
			"C" => sprintf("%02d", $cycles),
			"H" => sprintf("%02d", $hours),
			"i" => sprintf("%02d", $minutes),
			"S" => sprintf("%02d", $seconds),
			"z" => $days * 30 + $cycles,
			"g" => $hours % 12 + 1,
			"h" => sprintf("%02d", $hours % 12 + 1),
			"!" => "∇",
			"T" => "LST",
			"D" => $lunar_day_names[$days - 1],
		);
		
		return str_replace(array_keys($array), array_values($array), $format_string);
	}
?>
