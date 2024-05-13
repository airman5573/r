<?php
/*
Plugin Name: KBoard 에스크원 상담 스킨
Plugin URI: https://www.cosmosfarm.com/wpstore/product/kboard-qna-skin
Description: KBoard 에스크원 상담 스킨입니다.
Version: 2.8
Author: 코스모스팜 - Cosmosfarm
Author URI: https://www.cosmosfarm.com/
*/

if(!defined('ABSPATH')) exit;

add_filter('kboard_skin_list', 'kboard_skin_list_qna', 10, 1);
function kboard_skin_list_qna($list){

	$skin = new stdClass();
	$skin->dir = dirname(__FILE__);
	$skin->url = plugins_url('', __FILE__);
	$skin->name = basename($skin->dir);

	$list[$skin->name] = $skin;

	return $list;
}