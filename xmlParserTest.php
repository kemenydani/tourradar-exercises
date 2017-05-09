<?php
/**
 * Created by PhpStorm.
 * User: Dani
 * Date: 2017. 05. 09.
 * Time: 12:51
 */
require __DIR__ . '/xmlParser.php';

class xmlParserTest extends PHPUnit\Framework\TestCase {
	
	public function testReturnsFalseBecauseNoTours(){
	
$text = <<<XML
<?xml version="1.0"?>
<TOURS>

</TOURS>
XML;
		
		$this->assertEquals(false, xmlParser::xmlToCSV($text));
	}
	
}
