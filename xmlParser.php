<?php

/*
 * Notes: The Start and End fields were not required to print in the exercise.
 * It can be handled with a second parameter, like xmlToCSV($text, $printable = ['Title', 'Inclusions'...])
 * or xmlToCSV($text, $exclude = ['Start', 'End'...])
 * I didn't implemented that because having only one input parameter $text was also a requirement
 */

class xmlParser {
	
	public static function xmlToCSV(string $text){
		// Turning XML validation on
		libxml_use_internal_errors(true);
		// Evaluate all HTML entities
		$string = html_entity_decode($text, ENT_QUOTES, "utf-8");
		// Setting up the iteration of <TOUR> nodes
		$iterator = new SimpleXmlIterator($string, null);
		// Validating the XML
		if(empty(libxml_get_errors())){
			// Store tours <TOUR> in $tours
			$tours = $iterator->children();
			// Check if there are tours
			if(!empty($tours)){
				// Setting up the csv Headers
				// Removing DEP from headers
				$csv_headers = array_diff(array_keys((array)$tours[0]), ['DEP']);
				// Replacing DEP with MinPrice
				$csv_headers[] = "MinPrice";
				// Create header: col1|col2|col3...
				$output_csv = implode("|", $csv_headers);
				// Loop trough each tour
				foreach($tours as $tour) {
					// The content of the csv Body
					$csv_tour_content = [];
					// Setting default value for minPrice
					$minPrice = 0;
					// loop trough tour params
					foreach($tour as $param) {
						if($param->getName() === 'DEP'){
							// Handling the DEP parameters here
							// Calculate the MinPrice using the DEP attributes
							//$price = (float)$param->attributes()['EUR']->__toString();
							$price = isset($param->attributes()['EUR']) ? (float)$param->attributes()['EUR']->__toString() : 0;
							// Check if the discount attribute exists or not. If not, the value will be 0
							// casting (float) on a string like: 15% will remove the % character and turn 15 to float
							$discount = $param->attributes()['DISCOUNT'] !== null ? (float)$param->attributes()['DISCOUNT']->__toString() : 0;
							// Modify the price if the $discount is higher than it's default value (meaning it's set)
							if($discount > 0) $price = $price * ((100 - $discount) / 100);
							if($minPrice === 0){
								// $minPrice is 0 by default. This will set this value in the first iteration step
								$minPrice = $price;
							} else if(($minPrice - $price) > 0){
								// If the calculated price of the current DEP field is lower than the $minPrice, update it here
								$minPrice = $price;
							}
						} else {
							/*
							 * Handling the regular tags (like: Title) here.
							 * trim() removes the whitespaces and &nbsp;'s from the value
							 * strip_tags() removes the unnecessary HTML tags if they are present
							 */
							$csv_tour_content[$param->getName()] = trim(strip_tags($param->__toString()), " \t\n\r\0\x0B\xC2\xA0");
						}
					}
					// number_format formats the $price to have 2 decimal places
					$csv_tour_content['MinPrice'] = number_format($minPrice, 2, '.', '');
					// new row \n then create row: col1|col2|col3...
					$output_csv .= "\n" . implode("|", array_values($csv_tour_content));
				}
				return $output_csv;
			} // empty -> no tours
		} // XML error
		// Return false if there are any errors
		return false;
	}
	
}