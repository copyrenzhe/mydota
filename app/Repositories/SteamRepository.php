<?php namespace App\Repositories;

class SteamRepository {

	const COOKIE='./steam.cookie';
	const USERAGENT='Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36';
	const SEARCH_AJAX_URL='http://steamcommunity.com/search/SearchCommunityAjax';
	const REFERER='http://steamcommunity.com/search';
	const SEARCH_ACTION_URL='http://steamcommunity.com/search';

	private $text;
	private $page;
	private $steamid;
	private $filter;
	private $cookie;
	private $g_sessionID;
	
	public static function init($text, $page=1, $steamid=false, $filter='users', $cookie=self::COOKIE) {
		$Steam = new SteamRepository();
		$Steam->text = $text;
		$Steam->page = $page;
		$Steam->steamid = $steamid;
		$Steam->filter = $filter;
		$Steam->cookie = $cookie;
		$Steam->search();
		return $Steam;
	}
	
	public function search() {
		$html = $this->searchPage();
		$g_sessionID = $this->getSessionID($html);
		if(empty($g_sessionID)){
			return ;
		}
		$this->g_sessionID = $g_sessionID;
		$this->getHtmlLoop();		
	}
	
	private function searchPage() {
		return $this->send(self::SEARCH_ACTION_URL);
	}
	
	private function getSessionID($html) {
		$pattern = '/g_sessionID = \"(.*?)\"/iu';
		if(preg_match($pattern, $html, $matchs)) {
			$sessionId = $matchs[1];
		}
		return !empty($sessionId)?$sessionId:false;
	}

	private function getHtmlLoop(){
		$params = array(
				'text' => $this->text,
				'filter' => $this->filter,
				'sessionid' => $this->g_sessionID,
				'steamid_user' => $this->steamid,
				'page' => $this->page
		);
		$html = $this->send(self::SEARCH_AJAX_URL, 'GET', $params);
		$result = json_decode($html,true);
		$result_html = $result['html'];
		// $pattern = '/<div class\=\"search_row\"><div class\=\"search_result_friend\"><\/div><div class\=\"mediumHolder_default" data-miniprofile="217544967" style="float:left;"><div class\=\"avatarMedium\"><a href\=\"http\:\/\/steamcommunity\.com\/profiles\/(.*?)\"><img src\=\"(.*?)\"><\/a><\/div><\/div><div class\=\"searchPersonaInfo\"><a class\=\"searchPersonaName\" href\=\"http\:\/\/steamcommunity\.com\/profiles\/.*?\">(.*?)<\/a><br \/>(.*?)<br \/>(.*?)&nbsp;<img style\=\"margin-bottom\:-2px\" src\=\"(.*?)\" border\=\"0\" \/><\/div><div style\=\"clear\:left\"><\/div><div class\=\"search_match_info\"><div>Also known as\: <span style\=\"color\: whitesmoke\">(.*?)<\/span><\/div><\/div><\/div>/ix';
		$pattern = '/<div class\=\"mediumHolder_default" data-miniprofile\=\".*?\" style\=\"float:left;\"><div class\=\"avatarMedium\"><a href\=\"http\:\/\/steamcommunity\.com\/(profiles|id)\/(.*?)\"><img src\=\"(.*?)\"><\/a><\/div><\/div>/i';
		var_dump($result['html']);
		return;
	}
	
	private function send($url, $type='GET', $params=false) {
		$ch = curl_init($url); //初始化
		curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
		curl_setopt($ch, CURLOPT_COOKIEFILE,  $this->cookie); //发送cookies
		curl_setopt($ch, CURLOPT_COOKIEJAR,  $this->cookie); //存储cookies
		if($type==="POST") {
			curl_setopt($ch, CURLOPT_POST, 1);
		}
		if(!empty($params) && is_array($params)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_REFERER, self::REFERER);
		} else {
			curl_setopt($ch, CURLOPT_REFERER, self::REFERER);
		}
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, self::USERAGENT);
		$html = curl_exec($ch);
		//调试使用
		if ($html === FALSE) {
			echo "cURL Error: " . curl_error($ch);
		}
		curl_close($ch);
		return $html;
	}
}
