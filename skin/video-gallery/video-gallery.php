<?php
/*
Plugin Name: KBoard 화이클 비디오 스킨
Plugin URI: https://www.cosmosfarm.com/wpstore/product/video-gallery-skin
Description: KBoard 화이클 비디오 스킨입니다.
Version: 1.9
Author: 코스모스팜 - Cosmosfarm
Author URI: https://www.cosmosfarm.com
*/

if(!defined('ABSPATH')) exit;

add_filter('kboard_skin_list', 'video_gallery', 10, 1);
function kboard_skin_list_video_gallery($list){
	
	$skin = new stdClass();
	$skin->dir = dirname(__FILE__);
	$skin->url = plugins_url('', __FILE__);
	$skin->name = basename($skin->dir);
	
	$list[$skin->name] = $skin;
	
	return $list;
}