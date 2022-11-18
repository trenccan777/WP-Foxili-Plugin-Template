<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Test_Plugin_Metaboxes
{

    public static $slugs = array(
        'name',
    );

    public static function register()
    {
        $plugin = new self();
        add_action('add_meta_boxes', array($plugin, 'add'));
        add_action('save_post', array($plugin, 'save'));
    }

    /**
     * Set up and add the meta box.
     */
    public static function add()
    {
        $screens = ['custom-posts'];
        foreach ($screens as $screen) {
            add_meta_box(
                'test_plugin', // Unique ID
                'Test Plugin', // Box title
                [self::class, 'html'], // Content callback, must be of type callable
                $screen // Post type
            );
        }
    }

        /**
     * Save the meta box selections.
     *
     * @param int $post_id  The post ID.
     */
    public static function save(int $post_id)
    {   

        foreach (self::$slugs as $slug) {
            if (array_key_exists($slug, $_POST)) {
                update_post_meta(
                    $post_id,
                    $slug,
                    $_POST[$slug]
                );
            }
        }

    }

    /**
     * Display the meta box HTML to the user.
     *
     * @param \WP_Post $post   Post object.
     */
    public static function html($post)
    {

        $html = '';

        foreach (self::$slugs as $slug) {
            $value = get_post_meta($post->ID, $slug, true);

            $html .= "<div><label for='" . $slug . "'>" . $slug . "</label></div>";
            $html .= "<div><input name='" . $slug . "' type='text' value='" . $value . "'/></div>";

        }

        echo $html;
    }

}
Test_Plugin_Metaboxes::register();
