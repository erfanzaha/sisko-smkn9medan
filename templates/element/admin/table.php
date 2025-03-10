<?php 
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$replace_uri = str_replace('-', ' ', $uri_segments[2]);
$uri = str_replace(' ', '', ucwords($replace_uri));
$this->extend("/".$uri_segments[1]."/".$uri."/table/tbl-".$uri_segments[2]); 