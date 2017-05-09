<?php

class Anagram {
	
	/**
	 * @param string $string1
	 * @param string $string2
	 * @return bool
	 */
	public static function isAnagram(string $string1, string $string2): bool {
		// If the length of the strings not match, return false instantly, no need for wasting performance for other checks
		if(strlen($string1) !== strlen($string2)) return false;
		// If the words are the same, no need for other checks, return true. (strcasecmp is canse-insensitive)
		if(strcasecmp($string1, $string2) === 0)  return true;
		
		// Anagram check step 1. lower the characters, then split them to an arrays ($string1, $string2)
		$string1 = str_split(strtolower($string1));
		$string2 = str_split(strtolower($string2));
		// Step 2. sort the arrays (if they have the same characters, the order and the arrays will be the same
		sort($string1);
		sort($string2);
		// Step3. Compare the sorted arrays and return the boolean result
		return $string1 === $string2;
	}
	
}