<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       I
 * @since      1.0.0
 *
 * @package    Likedislikepost
 * @subpackage Likedislikepost/public/partials
 */
ob_start();
// echo "<h1>epta</h1>";
?>
<div class="like_dislike">
    
    <?php $this->the_ip_likes(); ?>
</div>
<?php
$output =  ob_get_clean();
