<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */
?>
<div class='wpblog_main'>
    <form id="blog_post_users" method="post">
        <div id="blog_editor">
        <?php 
        if(is_user_logged_in())
        {
            $content   = '';
            $editor_id = 'wpblg_blog_editor'; 
            wp_editor( $content, $editor_id );
            ?>
            </div>
            <div class="submit_blog">
                <?php wp_nonce_field('wpblg_secure','wpblg_nonce'); ?>
                <input type="submit" value="Post">
            </div>
            <?PHP 
        }else{
            ?>
            <label>
                <?php _e('You can create your own blog, Please login with the system.') ?>
            </label>   
            <?php
        }
        ?>
    </form>
    <div class='wpblog_list'>
        <?php 
        global $wpblg_comment;
        $wpblg_comment = true;
        $args = array(
            'post_type' => 'blogs',
            'posts_per_page' => -1,
        );
        $query1 = new WP_Query( $args );
        if ( $query1->have_posts() ) :
        // The Loop
            while ( $query1->have_posts() ) {
                $query1->the_post();
                $date = get_the_date();
                $time = get_the_time();
                $author_id =  get_the_author_ID();
                $user_info = get_userdata($author_id);
                $first_name = get_user_meta($author_id,'first_name',true);
                $last_name = get_user_meta($author_id,'last_name',true);
                $user_name = $user_info->user_nicename;
                if( $first_name && $last_name )
                {
                    $user_name = $first_name .' '.$last_name;
                }
                ?>
                <div class='wpblog_wrap'>
                    <div class='wpblog_heading'>
                        <span class='user_icon'><?php echo get_avatar($author_id,32); ?></span>
                        <div class="wp_user_name_time">
                            <h5><?php echo $user_name ?></h5>
                            <span class="date_time_post">
                                <?php 
                                echo wpblg_minutesConverter($date.' '.$time);
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class='wp_blog_contents'>
                    <?php the_content(); ?>
                    </div>
                    <div class='wpblog_comments'>
                        <?php 
                        if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </div>
                <?php
            }
        else:
            ?>
            <p><?php _e('No blogs are available','wp_blogger') ?></p>
            <?php
        endif;
        /* Restore original Post Data 
         * NB: Because we are using new WP_Query we aren't stomping on the 
         * original $wp_query and it does not need to be reset with 
         * wp_reset_query(). We just need to set the post data back up with
         * wp_reset_postdata().
         */
        wp_reset_postdata();
        $wpblg_comment = false;
        ?>
    </div>
</div>