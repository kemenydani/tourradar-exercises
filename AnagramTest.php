<?php
/**
 * Created by PhpStorm.
 * User: Dani
 * Date: 2017. 05. 04.
 * Time: 20:31
 */
require __DIR__ . '/Anagram.php';

class AnagramTest extends PHPUnit\Framework\TestCase{
	
	public function testIsNotAnagramBecauseOfDifferentCharCount(){
		$this->assertEquals(false, Anagram::isAnagram("apple", "foo"));
	}
	
	public function testIsNotAnagramBecauseOfDifferentWordsButSameCharCount(){
		$this->assertEquals(false, Anagram::isAnagram("apple", "stack"));
	}
	
	public function testIsAnagram(){
		$this->assertEquals(true, Anagram::isAnagram("AlMa", "lama"));
	}
}
