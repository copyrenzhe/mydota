<?php


	function http_curl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	}

	/**
	 * filter \n,\t,\r
	 * @param  string $string 
	 * @return string
	 */
	function del_html($string)
	{
		$string = str_replace(' ', '', $string);
		$string = str_replace("\n","",$string);
		$string = str_replace("\r","",$string);
		$string = str_replace("\t","",$string);
		return $string;
	}

	function p($arr)
	{
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}


?>