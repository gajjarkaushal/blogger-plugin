<?php
if(!class_exists('Wpblg_Request_Handle'))
{
    class Wpblg_Request_Handle
    {
        function __construct()
        {
            add_action('init',array($this,'wpblg_init'),10);
        	$this->wpblg_wordpress_hooks();
        }
        /*
        * Init Handle
        */
        function wpblg_init()
        {
        	if( is_user_logged_in() && isset($_POST['wpblg_nonce']) && wp_verify_nonce($_POST['wpblg_nonce'],'wpblg_secure') )
        	{
                if(sanitize_textarea_field($_POST['wpblg_blog_editor']))
                {
            		// Create post object
            		$title = wp_strip_all_tags($_POST['wpblg_blog_editor']);
            		$title = wp_trim_words( $title,20, '' );
    				$my_post = array(
    				  'post_title'    => $title,
    				  'post_content'  => sanitize_textarea_field($_POST['wpblg_blog_editor']),
    				  'post_status'   => 'publish',
    				  'post_author'   => get_current_user_id(),
    				  'post_type'     => 'blogs',
    				  'comment_status' => 'open'
    				);
    				// Insert the post into the database
    				wp_insert_post( $my_post );
                    $request_url = isset($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] :'';
                    if($request_url)
                    {
                        wp_redirect($request_url);
                        die;
                    }
                }else{
                    //add_action('')
                }
        	}
        }
        /*
        * Wordpress Hooks
        */
        function wpblg_wordpress_hooks()
        {
        	add_filter( 'comments_template', array($this,'wpblg_comment_template') );
            add_filter('comment_form_defaults',array($this,'wpblg_comment_form_callback'),9999);
            add_action('comment_form_top',array($this,'wpblg_comment_form_top'));
            add_filter('comment_post_redirect',array($this,'wpblg_comment_done_redirect'),10,2); 
        }
        /*
        * Comment template path change
        */
        function wpblg_comment_template($theme_template)
        {
            global $wpblg_comment;
            if($wpblg_comment)
            {
        	   return WPBLG_TEMPLATES.'wpblg-comments.php';
            }
            return $theme_template;
        }
        /*
        * Comment form arg changes
        */
        function wpblg_comment_form_callback($args)
        {
            global $wpblg_comment;
            if($wpblg_comment)
            {
                $args['title_reply'] = '';
                $args['title_reply_to'] = '';
                $args['title_reply_before']= '';
                $args['logged_in_as'] = '';
            }
            return $args;
        }
        /*
        * Comment box top comment
        */
        function wpblg_comment_form_top()
        {
            global $wpblg_comment;
            if($wpblg_comment)
            {
                ?>
                <input type='hidden' name="wpblg_redirect" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <?php
            }
        }
        /*
        * Comment redirect
        */ 
        function wpblg_comment_done_redirect($location, $comment)
        {
            if(isset($_POST['wpblg_redirect']) && !empty($_POST['wpblg_redirect']))
            {
                return $_POST['wpblg_redirect'];
            }
            return $location;
        }
    }
    new Wpblg_Request_Handle();
}