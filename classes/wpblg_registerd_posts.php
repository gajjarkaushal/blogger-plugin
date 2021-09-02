<?php
if(!class_exists('Wpblg_Registered_Post'))
{
    class Wpblg_Registered_Post
    {
        public function __construct(){
            add_action('init',array($this,'wpblg_registed_post_type'),10);     
        }
        /*
        * registered posttype
        */
        public function wpblg_registed_post_type()
        {
            $labels = array(
                'name'                  => _x( 'Blogs', 'Post type general name', 'wp_blogger' ),
                'singular_name'         => _x( 'Blogs', 'Post type singular name', 'wp_blogger' ),
                'menu_name'             => _x( 'Blogs', 'Admin Menu text', 'wp_blogger' ),
                'name_admin_bar'        => _x( 'Blogs', 'Add New on Toolbar', 'wp_blogger' ),
                'add_new'               => __( 'Add Blog', 'wp_blogger' ),
                'add_new_item'          => __( 'Add New Blogs', 'wp_blogger' ),
                'new_item'              => __( 'New Blog', 'wp_blogger' ),
                'edit_item'             => __( 'Edit Blog', 'wp_blogger' ),
                'view_item'             => __( 'View Blog', 'wp_blogger' ),
                'all_items'             => __( 'All Blogs', 'wp_blogger' ),
                'search_items'          => __( 'Search Blogs', 'wp_blogger' ),
                'parent_item_colon'     => __( 'Parent Blogs:', 'wp_blogger' ),
                'not_found'             => __( 'No Blogs found.', 'wp_blogger' ),
                'not_found_in_trash'    => __( 'No Blogs found in Trash.', 'wp_blogger' ),
                'featured_image'        => _x( 'Blog Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'wp_blogger' ),
                'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'wp_blogger' ),
                'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'wp_blogger' ),
                'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'wp_blogger' ),
                'archives'              => _x( 'Blog archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'wp_blogger' ),
                'insert_into_item'      => _x( 'Insert into Blog', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'wp_blogger' ),
                'uploaded_to_this_item' => _x( 'Uploaded to this Blog', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'wp_blogger' ),
                'filter_items_list'     => _x( 'Filter Blogs list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'wp_blogger' ),
                'items_list_navigation' => _x( 'Blog list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'wp_blogger' ),
                'items_list'            => _x( 'Blog list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'wp_blogger' ),
            );
         
            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'blogs' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            );
         
            register_post_type( 'blogs', $args );
            if(!get_option('wpblg_flush_data'))
            {
                flush_rewrite_rules();
                update_option('wpblg_flush_data','true');
            }
        }
    }
    new Wpblg_Registered_Post();
}