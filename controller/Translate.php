<?php  
	class Translate {
		function __construct() {
			
		}
		//$var = new Trans
		/**
		 * translate to english
		 */
		function toEnglish($text) {
			$apiKey = '';
			$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=fr&target=en';
			
			$handle = curl_init($url);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($handle);
			$responseDecoded = json_decode($response, true);
			curl_close($handle);
			
			return $responseDecoded['data']['translations'][0]['translatedText'];
		}
	}
?>