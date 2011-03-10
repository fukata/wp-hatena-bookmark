<?php

function hatena_entries($blogurl, $filter=array('count'=>5,'sort'=>'count')) {
	$url = _hatena_entries_url($blogurl, $filter);
	$entries = _get_hatena_entries_cache($url);
	if (empty($entries)) {
		$rdf = file_get_contents($url);	
		$rdf = str_replace('dc:date', 'dc_date', $rdf);
		$rdf = str_replace('dc:subject', 'dc_subject', $rdf);
		$rdf = str_replace('hatena:bookmarkcount', 'hatena_bookmarkcount', $rdf);
		$data = simplexml_load_string($rdf);
		_set_hatena_entries_cache($url, $rdf);
		$entries = $data->item;
	}

	$count = isset($filter['count']) && is_numeric($filter['count']) ? intval($filter['count']) : 5;
	$count = count($entries) > $count ? $count : count($entries);
	$list = array();
	for ($i=0; $i<$count; $i++) {
		$list[] = $entries[$i];
	}
	return $list;
}

function _hatena_entries_url($blogurl, $filter) {
	$url = "http://b.hatena.ne.jp/entrylist?url=$blogurl";
	foreach ($filter as $key => $val) {
		$url .= "&$key=$val";
	}
	$url .= "&mode=rss";
	return $url;
}

function _hatena_popular_cache($url) {
	return dirname(__FILE__).'/'.md5($url).'.cache';
}

function _get_hatena_entries_cache($url) {
	$filename = _hatena_popular_cache($url);
	$cache_limit = time() + (60 * 60 * 1);
	if (!file_exists($filename) || $cache_limit > filectime($filename)) {
		return null;
	}
	$rdf = file_get_contents($filename);
	if (empty($rdf)) {
		return null;
	}
	$data = simplexml_load_string($rdf);
	return $data->item;
}

function _set_hatena_entries_cache($url, $rdf) {
	$fp = fopen(_hatena_popular_cache($url), 'wb');
	fwrite($fp, $rdf);
	fclose($fp);
}

?>
