<?php

require __DIR__ . '/Anagram.php';
require __DIR__ . '/xmlParser.php';


/**
 * Exercise 1: Anagram
 */

$string1 = "Alma";
$string2 = "lAmA";

$is_anagram = Anagram::isAnagram($string1, $string2);

if($is_anagram){
	echo $string1 . " and " . $string2 . " are anagrams! ";
} else {
	echo $string1 . " and " . $string2 . " are not anagrams! ";
}

echo "<br><br>";

/**
 * Exercise 2: parse XML to CSV
 */

$text = <<<XML
<?xml version="1.0"?>
<TOURS>
    <TOUR>
        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
        <Code>AE-19</Code>
        <Duration>18</Duration>
        <Start>Istanbul</Start>
        <End>Cairo</End>
        <Inclusions>
            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
        </Inclusions>
        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />
        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" />
    </TOUR>
    <TOUR>
        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
        <Code>AE-19</Code>
        <Duration>18</Duration>
        <Start>Istanbul</Start>
        <End>Cairo</End>
        <Inclusions>
            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
        </Inclusions>
        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1000" USD="2350" DISCOUNT="15%" />
        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" />
    </TOUR>
    
</TOURS>
XML;

$csv = xmlParser::xmlToCSV($text);

if($csv){
	echo nl2br($csv);
} else {
	echo "Invalid XML";
}
