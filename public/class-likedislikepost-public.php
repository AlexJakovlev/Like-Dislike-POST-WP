<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       I
 * @since      1.0.0
 *
 * @package    Likedislikepost
 * @subpackage Likedislikepost/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Likedislikepost
 * @subpackage Likedislikepost/public
 * @author     I <alex10041972@gmail.com>
 */
class Likedislikepost_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->my_plugin_options = get_option($this->plugin_name);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Likedislikepost_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Likedislikepost_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/likedislikepost-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Likedislikepost_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Likedislikepost_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/likedislikepost-public.js', array('jquery'), $this->version, false);
	}

	function the_ip_likes()
	{
		if (!is_singular('page')) {
			$title = __("likes:", $this->plugin_name);
			$button = "";
			$likes = get_post_meta(get_the_id(), 'likes', true);
			$likes = $likes === "" ? array() : $likes;

			$count_likes = $likes ? count($likes) : 0;
			update_post_meta(get_the_id(), 'likescount', $count_likes);
			if (is_user_logged_in()) {
				$cheket = "";
				$title_button = __("Like", $this->plugin_name);
				if ($likes) {
					if (array_key_exists(get_current_user_id(), $likes)) {
						$cheket = "ldpcheket";
						$title = __("You and more:", $this->plugin_name);
						$title_button = __("Liked", $this->plugin_name);
						$count_likes -= 1;
					}
				}
				$button = '<button data-id="' . get_the_id() . '" data-url="' . admin_url("admin-ajax.php") . '" class="ip_post_likes ' . $cheket . '">' . $title_button . '</button>';
				"<button class='like_dislike_button " . $cheket . "'>" . $title_button . "</button>";
			};
			echo  '<div id="ldp' . get_the_id() . '" class="like_dislike_text">
		<p>' . __($title, $this->plugin_name) . " " . $count_likes . '</p>
		</div>';
			echo $button;
		}
	}


	public function likedislikepost($content)
	{
		include('partials/likedislikepost-public-display.php');
		return $content . $output;
	}
	public function ip_process_like()
	{
		$title = __("likes:", $this->plugin_name);
		$button = __("Like", $this->plugin_name);
		$processed_like = false;
		$post_id = $_POST['id'];
		$likes  = get_post_meta($post_id, 'likes', true);
		$likes = $likes === "" ? array() : $likes;
		$count_likes = $likes ? count($likes) : 0;
		if (array_key_exists(get_current_user_id(), $likes)) {
			unset($likes[get_current_user_id()]);
			$count_likes -= 1;
		} else {
			$likes[get_current_user_id()] = true;
			$title = __("You and more:", $this->plugin_name);
			$button = __("Liked", $this->plugin_name);
		}

		$processed_like = update_post_meta($post_id, 'likes', $likes);
		if ($processed_like) {
			$title = $title . " " . $count_likes;
			echo json_encode(array("title" => $title, "button" => $button));
		}
		die;
	}

	public function top_like_post()
	{
		$options = unserialize(get_option($this->plugin_name));
		$count_post = intval($options['count_post']);

		$posts = get_posts(array(
			'numberposts' => $count_post,
			'category'    => 0,
			'orderby'     => 'meta_value',
			'order'       => 'ASC',
			'include'     => array(),
			'exclude'     => array(),
			'meta_key'    => 'likescount',
			'meta_value'  => '',
			'post_type'   => 'post',
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		));
		// post_title guid
		ob_start();
		echo "<ul class='top_like_post'>";
		foreach ($posts as $post) {

			echo "<li class='top_like_post_item'><a href=" . $post->guid . ">" . $post->post_title . "</a></li>";
		}
		echo "</ul>";
		return ob_get_clean();
	}
}
