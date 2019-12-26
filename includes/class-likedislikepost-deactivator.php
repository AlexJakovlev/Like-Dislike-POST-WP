<?php

/**
 * Fired during plugin deactivation
 *
 * @link       I
 * @since      1.0.0
 *
 * @package    Likedislikepost
 * @subpackage Likedislikepost/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Likedislikepost
 * @subpackage Likedislikepost/includes
 * @author     I <alex10041972@gmail.com>
 */
class Likedislikepost_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$options = get_option('likedislikepost');
		// var_dump($options['clear_database']);
		// die;
		 if ($options['clear_database'] === "true") {
		delete_metadata("post", 0, "likes" , "", true);
		delete_option('likedislikepost');
		delete_metadata("post", 0, "likescount", "", true);
		}
	}
}
