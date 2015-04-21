<?php namespace App\Repositories;

use PhpQuery\PhpQuery as phpQuery;

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
	private $steamLink;
	private $steamId;
	private $headImg;
	private $account;
	private $trueName;
	private $country;
	private $countryImg;
	private $cname;
	
	public static function init($text, $page=1, $steamid=false, $filter='users', $cookie=self::COOKIE) {
		$Steam = new SteamRepository();
		$Steam->text = $text;
		$Steam->page = $page;
		$Steam->steamid = $steamid;
		$Steam->filter = $filter;
		$Steam->cookie = $cookie;
		return $Steam->search();
	}
	
	public function search() {
		$html = $this->searchPage();
		$g_sessionID = $this->getSessionID($html);
		if(empty($g_sessionID)){
			return ;
		}
		$this->g_sessionID = $g_sessionID;
		return $this->getAllElements();		
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

	private function getAllElements(){
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
		//$pattern = '/<div class\=\"mediumHolder_default" data-miniprofile\=\".*?\" style\=\"float:left;\"><div class\=\"avatarMedium\"><a href\=\"http\:\/\/steamcommunity\.com\/(profiles|id)\/(.*?)\"><img src\=\"(.*?)\"><\/a><\/div><\/div>/i';
		//__DIR__.'/../app/functions.php';
		// $result_html = file_get_contents('http://www.belusky.com/test.html');
		$res = phpQuery::newDocument($result_html);
		$search_row = phpQuery::pq($res)->find('.search_row');
		
		phpQuery::each($search_row,function($item,$data){
			$this->steamLink[] = $steamLink = phpQuery::pq($data)->find('.avatarMedium a')->attr('href');
			$this->steamId[] = $this->getSteamId($steamLink);
			$this->headImg[] = phpQuery::pq($data)->find('.avatarMedium')->find('img')->attr('src');
			$this->account[] = phpQuery::pq($data)->find('.searchPersonaName')->html();
			$string = phpQuery::pq($data)->find('.searchPersonaInfo')->html();
			$string = preg_replace('/(<a.*?>.*?<\/a>)/i', '', $string);
			$string = preg_replace('/(<img.*?>)/i', '', $string);
			$string = del_html($string);
			$Arr = explode('<br>', $string);
			$this->country[] = $Arr[count($Arr)-1];
			$this->trueName[] = $Arr[count($Arr)-2];
			$this->countryImg[] = phpQuery::pq($data)->find('.searchPersonaInfo')->find('img')->attr('src');
			$match_info = phpQuery::pq($data)->find('.search_match_info')->html();
			$match_info_arr = explode('Also known as:', $match_info);
			if(!empty($match_info_arr[1])){
				$match_info_arr[1] = preg_replace('/<\/?div.*?>/i', '', $match_info_arr[1]);
			}else{
				$match_info_arr[1] = '';
			}
			$this->cname[] = del_html(preg_replace('/<\/?span.*?>/i', '', $match_info_arr[1]));
		});
		// var_dump($result['html']);
		foreach ($this->steamLink as $key => $value) {
			$r[$key]['steamLink'] = $value;
			$r[$key]['steamId'] = $this->getSteamId($value);
			$r[$key]['headImg'] = $this->headImg[$key];
			$r[$key]['account'] = $this->account[$key];
			$r[$key]['country'] = $this->country[$key];
			$r[$key]['trueName'] = $this->trueName[$key];
			$r[$key]['countryImg'] = $this->countryImg[$key];
			$r[$key]['cname'] = $this->cname[$key];
		}
		return $r;
	}

	/**
	 * get steamid with steamlink from http://steamidfinder.com/
	 * @return Array
	 * @example  $steamLink = 'http://steamcommunity.com/id/ronnocoenahs';
	 *           return array(
	 *            		converted: "STEAM_0:0:57501155",
	 *					steam2Id: "STEAM_0:0:57501155",
	 *					steam3Id: "U:1:115002310",
	 *					steam64: "76561198075268038"
	 *					);
	 */

	private function getSteamId($steamLink){
		$pattern = '/g_rgProfileData \= \{\"url\"\:.*?\"steamid\"\:\"(.*?)\".*?\}/';
		$steamHomePage = $this->send($steamLink);
		preg_match($pattern,$steamHomePage,$matchs);
		return $matchs[1];
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
