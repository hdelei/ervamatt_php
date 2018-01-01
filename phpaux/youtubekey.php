<?php

$apiURL = 'https://www.googleapis.com/youtube/v3/videos?id=SET_NEW_ID';
$apiURL .= '&key=AIzaSyApyjodUSvYUvqYFB3r41ebNpg_LVc9R9Q&fields=items';
$apiURL .= '(id,snippet(title),statistics)&part=snippet,statistics';

function getYouTubeIdFromURL($url){
    if (strlen($url) == 11){
        $url = "https://www.youtube.com/watch?v=".$url;
    }   

    $url_string = parse_url($url, PHP_URL_QUERY);
    parse_str($url_string, $args);
    return isset($args['v']) ? $args['v'] : false;
}

if(isset($_GET['url'])){
    $url = $_GET['url'];    
    $youtube_id = getYoutubeIdFromURL($url);
    
    if($youtube_id == false || strlen($youtube_id) < 11){
        echo '{"error":"Video invalido!"}';    
    }
    else{
        $apiURL = str_replace("SET_NEW_ID", $youtube_id, $apiURL);
        $content = file_get_contents($apiURL);
        
        echo $content;
    }        
}
else{
    echo '{"error":"Link invalido!"}';
}