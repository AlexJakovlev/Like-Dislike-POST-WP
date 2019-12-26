<?php

/**
 * Fired during plugin activation
 *
 * @link       I
 * @since      1.0.0
 *
 * @package    Likedislikepost
 * @subpackage Likedislikepost/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Likedislikepost
 * @subpackage Likedislikepost/includes
 * @author     I <alex10041972@gmail.com>
 */
class Likedislikepost_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$options = get_option('likedislikepost');
		// var_dump($options);
		// die;
		if (!$options){
			// ["clear_database"]);
			// die;
			// if ($options["clear_database"]){
			$options['count_post'] = "5";
			add_option('likedislikepost', $options);
			// add_option("likedislikepost_top_like_post", serialize(array())); 
		}	
	}
}
