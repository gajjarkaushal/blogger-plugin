<?php
if(!class_exists('Wpblg_Shortcodes'))
{
    class Wpblg_Shortcodes
    {
        function __construct()
        {
            add_shortcode('wpblg_blogs',array($this,'wpblg_blogs_views_callback'));
        }
        /*
        * Blog views callback
        */
        function wpblg_blogs_views_callback()
        {
            ob_start();
            include(WPBLG_TEMPLATES.'wpblg-blogs-listing.php');
            return ob_get_clean();
        }
    }
    new Wpblg_Shortcodes();
}