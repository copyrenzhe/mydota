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

	/**
	 * 格式化数字
	 * @param  float  $float  欲格式化的数字	    
	 * @param  integer $num    欲保留的精度
	 * @param  boolean $is_round   是否四舍五入
	 * @param  boolean $is_percent 是否以百分比形式显示结果
	 * @return string 
	 */
	function formatFloat($float,$num=2,$is_round=true,$is_percent=true)
	{
		if($is_round){
			if($is_percent){
				return sprintf('%.'.$num.'f',$float*100).'%';
			}
			return sprintf('%.'.$num.'f',$float);
		} else {
			if($is_percent){
				$arr = explode('.', $float*100);
				if(isset($arr[1])){
					$arr[1] = substr($arr[1],0,$num);
				}
				return implode('.', $arr).'%';
			} else {
				$arr = explode('.', $float);
				if(isset($arr[1])){
					$arr[1] = substr($arr[1],0,$num);
				}
				return implode('.', $arr);
			}

		}

	}

?>