<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       I
 * @since      1.0.0
 *
 * @package    Likedislikepost
 * @subpackage Likedislikepost/admin/partials
 */

if (isset($_POST['submit'])) {
    if (
        function_exists('current_user_can') &&
        !current_user_can('manage_options')
    )
        die(__('Hacker?', 'likedislikepost'));

    // $options = array();
    $options["clear_database"] = $_POST["likedislikepost"]["clear_database"];
    $options['count_post'] = $_POST["likedislikepost"]['count_post'];
    update_option('likedislikepost', $options);
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1>Страница настроек</h1>

<form method="post" name="my_options" action="options-general.php?page=likedislikepost">

    <?php

    // Загрузить все значения элементов формы
    $options = get_option($this->plugin_name);

    // текущие состояние опций
    $clear_database = $options['clear_database'];
    $count_post = intval($options['count_post']);
    // Выводит скрытые поля формы на странице настроек
    settings_fields($this->plugin_name);
    do_settings_sections($this->plugin_name);
    ?>
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <fieldset>
        <legend class="screen-reader-text"><span><?php _e('Clear database when deactivated', $this->plugin_name); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-clear_database">
            <span><?php esc_attr_e('Clear database when deactivated', $this->plugin_name); ?></span>
        </label>
        <input type="checkbox" <?php echo $clear_database === "true" ? "checked" : "" ?> class="" id="<?php echo $this->plugin_name; ?>-clear_database" name="<?php echo $this->plugin_name; ?>[clear_database]" value="true" />
    </fieldset>
    <fieldset>
        <legend class="screen-reader-text"><span><?php _e('How many posts to display', $this->plugin_name); ?></span></legend>
        <label for="<?php echo $this->plugin_name; ?>-count_post">
            <span><?php esc_attr_e('How many posts to display', $this->plugin_name); ?></span>
        </label>
        <select name="<?php echo $this->plugin_name; ?>[count_post]">&nbsm
            <?php
            for ($i = 0; $i < 9; $i++) {

            ?>
                <option <?php echo ($i + 2) === $count_post ?  "selected" : "" ?> value="<?php echo $i + 2 ?>"><?php echo $i + 2 ?></option>
            <?php
            }
            ?>
        </select>
        <span> [top_like_post] -- <span><?php echo __("Short cod for insert") ?></span></span>
    </fieldset>
    <?php submit_button(__('Save all changes', $this->plugin_name), 'primary', 'submit', TRUE); ?>

</form>