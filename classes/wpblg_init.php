<?php
if(!class_exists('Wpblg_Init'))
{
    class Wpblg_Init
    {
        function __construct(){
            add_action( 'wp_enqueue_scripts', array($this,'wpblg_my_enqueue_scripts'),10);
            $this->wpblg_include_files();       
        }
        /*
        * Add Style and script
        */
        function wpblg_my_enqueue_scripts()
        {   
             wp_enqueue_style( 'wpblg_style', WPBLG_ASSETS.'css/style.css' );
        }
        /*
        * Include files
        */
        function wpblg_include_files(){
            include(WPBLG_INC.'functions.php'); 
            include(WPBLG_CLS.'wpblg-request-handle.php'); 
            include(WPBLG_CLS.'wpblg_registerd_posts.php');  
            include(WPBLG_CLS.'wpblg_shortcodes.php'); 
        }
    }
    new Wpblg_Init();
}
?>