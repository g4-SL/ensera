<?php

if(!isset($_GET['search-term'])) {
	die('You must define a search term!');
}

$search_in = array('html', 'htm', 'php');
$search_dir = '../templates';
$recursive = true;
define('SIDE_CHARS', 111);
$file_count = 0;
$search_term = mb_strtolower($_GET['search-term'], 'UTF-8');
$search_term_length = strlen($search_term);
$final_result = array();

$files = list_files($search_dir);

foreach($files as $file){
	$contents = file_get_contents($file);
	
	preg_match("/\<h1\>(.*)\<\/h1\>/", $contents, $page_title); //getting page title
	if($page_title[1] == "")  {preg_match("/\<h2\>(.*)\<\/h2\>/", $contents, $page_title);} //getting page title
	
	if (preg_match("#\<section.*\>(.*)\<\/section\>#si", $contents, $body_content)){ //getting content only between <body></body> tags
		$clean_content = strip_tags($body_content[0]); //remove html tags
		$clean_content = preg_replace( '/\f+/', ' ', $clean_content ); //remove duplicate whitespaces, carriage returns, tabs, etc
	
	$found = strpos_recursive(mb_strtolower($clean_content, 'UTF-8'), $search_term);
	$final_result[$file_count]['page_title'][] = $page_title[1];
	$final_result[$file_count]['file_name'][] = $file;
}
	if($found && !empty($found)) {
		for ($z = 0; $z < count($found[0]); $z++){
			$pos = $found[0][$z][1];
			$side_chars = SIDE_CHARS;
			if ($pos < SIDE_CHARS){
				$side_chars = $pos;
				$pos_end = SIDE_CHARS + $search_term_length;
			}else{
				$pos_end = SIDE_CHARS*2 + $search_term_length;
			}

			$pos_start = $pos - $side_chars;
			$str = substr($clean_content, $pos_start, $pos_end);
			$result = preg_replace('#'.$search_term.'#ui', '<span style="background:yellow" class="search">\0</span>', $str);
			$final_result[$file_count]['search_result'][] = $result;
		}
	} else {
		$final_result[$file_count]['search_result'][] = '';
	}
	$file_count++;
}


//lists all the files in the directory given (and sub-directories if it is enabled)
function list_files($dir){
	global $recursive, $search_in;

	$result = array();
	if(is_dir($dir)){
		if($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false) {
				if(!($file == '.' || $file == '..')){
					$file = $dir.'/'.$file;
					if(is_dir($file) && $recursive == true && $file != './.' && $file != './..'){
						$result = array_merge($result, list_files($file));
					}
					else if(!is_dir($file)){
						if(in_array(get_file_extension($file), $search_in)){
							$result[] = $file;
						}
					}
				}
			}
		}
	}
	return $result;
}

function get_file_extension($filename){
	$result = '';
	$parts = explode('.', $filename);
	if(is_array($parts) && count($parts) > 1){
		$result = end($parts);
	}
	return $result;
}

function strpos_recursive($haystack, $needle, $offset = 0, &$results = array()) {               
    $offset = stripos($haystack, $needle, $offset);
    if($offset === false) {
        return $results;           
    } else {
        $pattern = '/'.$needle.'/ui';
	preg_match_all($pattern, $haystack, $results, PREG_OFFSET_CAPTURE);
		return $results;
    }
}
?>