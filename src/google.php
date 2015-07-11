<?php
namespace Goproxy;
class Google
{

	public static function getGoogleUrl($keyword) {
		$keyword = urlencode($keyword);
		return "http://www.google.se/search?hl=sv&as_q={$keyword}&as_epq=&as_oq=&as_eq=&lr=&as_filetype=&ft=i&as_sitesearch=&as_qdr=all&as_rights=&as_occt=any&cr=&as_nlo=&as_nhi=&safe=images&num=100";
	}

	public static function search_keyword( $keyword )
	{
		$url = self::getGoogleUrl($keyword);

		$result = self::crawl(
		    $url,
		    'http://www.google.se/',
		    'Mozilla/5.0 (Windows; U; Windows NT 5.1; sv-SE; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3',
		    1,
		    5
	    );

	    print_r($result);

	}

	public static function crawl($url, $referer, $agent, $header, $timeout) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, $header);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_ENCODING , "gzip");

	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	    curl_setopt($ch, CURLOPT_REFERER, $referer);
	    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20); //timeout in seconds

	    $result['EXE'] = curl_exec($ch);
	    $result['INF'] = curl_getinfo($ch);
	    $result['ERR'] = curl_error($ch);
	 
	    curl_close($ch);
	 
	    return $result;
	}
}