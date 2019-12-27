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

		if (!$options){
			$options['count_post'] = "5";
			add_option('likedislikepost', $options);
		}	
	}
}
