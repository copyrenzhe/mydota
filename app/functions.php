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

	function microtime_float()
	{
	   list($usec, $sec) = explode(" ", microtime());
	   return((float)$usec+ (float)$sec);
	}

	function update_dota2_json($path,$array){
		$json = json_encode($array);
        chmod(dirname(__FILE__), 0777);
        $file = fopen(__DIR__.'/../vendor/kronusme/dota2-api/data/' . $path.'.json', 'w+');
        fwrite($file, $json);
        fclose($file);
        unset($file);
	}

?>