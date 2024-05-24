<?php
/*
Plugin Name: KBoard 화이클 비디오 최신글 슬라이더
Plugin URI: https://www.cosmosfarm.com/wpstore/product/kboard-hwaikeul-video-latest
Description: KBoard 화이클 비디오 최신글 슬라이더입니다.
Version: 1.1
Author: 코스모스팜 - Cosmosfarm
Author URI: https://www.cosmosfarm.com/
*/

if(!defined('ABSPATH')) exit;

add_filter('kboard_skin_latestview_list', function($list){
	$skin = new stdClass();
	$skin->dir = dirname(__FILE__);
	$skin->url = plugins_url('', __FILE__);
	$skin->name = basename($skin->dir);
	
	$list[$skin->name] = $skin;
	
	return $list;
}, 10, 1);

if(!function_exists('revew_sldier_list')){
	function revew_sldier_list($board, $is_latest=false){
		$classes = array();
		
		if($is_latest){
			if(!wp_is_mobile() && $board->meta->latest_row){
				$classes[] = "hwaikeul-video-row-{$board->meta->latest_row}";
			}
		}
		else{
			if(!wp_is_mobile() && $board->meta->pc_row){
				$classes[] = "hwaikeul-video-row-{$board->meta->pc_row}";
			}
			if(wp_is_mobile() && $board->meta->mobile_row){
				$classes[] = "hwaikeul-video-row-{$board->meta->mobile_row}";
			}
		}
		
		$classes = implode(' ', $classes);
		
		return $classes;
	}
}