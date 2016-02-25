<?php 

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  
        '/[^\S ]+\</s',  
        '/(\s)+/s'       
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

$p = explode("/", $_SERVER['REQUEST_URI'] );

if($p[1] == "gallery") {
  $title = "Gallery | Ensera Gallery Borneo";
  $description = "Gallery";
} else if($p[1] == "about") {
  $title = "About | Ensera Gallery Borneo";
  $description = "About";
} else if($p[1] == "contact") {
  $title = "Contact Us | Ensera Gallery Borneo";
  $description = "Contact Us";
} else if($p[1] == "404") {
  $title = "Not Found | Ensera Gallery Borneo";
  $description = "Contact Us";
} else {
  $title = "Ensera Gallery Borneo";
  $description = "Ensera Gallery Borneo";
}


$recursive = true;
$search_in = array('html', 'htm', 'php');
function curPageURL() {return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";}
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

ob_start("sanitize_output");
include './header.php';

  $files = list_files('templates');
  $tempUrl = "";
  $notfound = true;
  if(isset($p[1])){
    if($p[1] == "home" || $p[1] == ""){$tempUrl = "templates/base";}
    else{$tempUrl = "templates/".$p[1];}
  }
  if(isset($p[2]) && $p[2] != ""){$tempUrl = $tempUrl."/".$p[2];}
  if(isset($p[3]) && $p[3] != ""){$tempUrl = $tempUrl."/".$p[3];}
  if(isset($p[4]) && $p[4] != ""){$tempUrl = $tempUrl."/".$p[4];}
  $tempUrl = $tempUrl.".php";

  foreach($files as $file){
    if($tempUrl == $file){
      include $tempUrl;
      $notfound = false;
    }
  }

  if($notfound == true){
    http_response_code(404);
    include 'templates/404.php';
  }

include './footer.php';
?>