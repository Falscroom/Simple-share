<?php
/*
Plugin Name: simple-material-share-buttons
Description: Simple share buttons with material design using material design lite by Google
Version: 1.0
Author: Falscroom
*/

/*  Copyright 2017  Falscroom  (email: Falscroom@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
class simple_share {
    private $path,$icons,$result;
    function __construct($icons)
    {

	    wp_enqueue_script( 'share-script', plugin_dir_url(__FILE__ ) . '/js/share-script.js');
	    wp_enqueue_style( 'share-style', plugin_dir_url(__FILE__ ) . '/css/main.css');

        $this->path = plugin_dir_url( __FILE__ ) . 'icons/';
        foreach ($icons as $key => $icon_color) {
            $this->icons[$key][0] = $this->path . $icon_color[0];
            $this->icons[$key][1] = $icon_color[1];
        }
    }
    function create_buttons() {
        foreach ($this->icons as $key => $icon_color) {
            $current_post_link = get_permalink();
            $current_post_title = get_the_title();
            $current_post_excerpt = get_the_excerpt();
            $current_post_image = get_the_post_thumbnail_url(null,'large');
            $this->result .= "<button onclick= \"Share.vkontakte('{$current_post_link}','{$current_post_title}','{$current_post_excerpt}','{$current_post_image}') \" class=\"mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored simple-share\" 
            style='background-image: url({$icon_color[0]}); background-color: {$icon_color[1]}'> </button>";
        }
        return $this->result;
    }
}

function init($args) {
	$share_class = new simple_share([['vk-social-network-logo.png','#507299'],['facebook.png','#3b5998']]);
    return $share_class->create_buttons();
}
add_shortcode('share-buttons','init');