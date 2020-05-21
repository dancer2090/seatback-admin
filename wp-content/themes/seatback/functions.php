<?php
/* Hide WP version strings from scripts and styles
* @return {string} $src
* @filter script_loader_src
* @filter style_loader_src
*/
/*
function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');
*/
add_action( 'template_redirect', function() {
    wp_redirect( 'https://seatback.webbuilder.in.ua/', 301 );
    exit;
} );


if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
        'page_title'    => __('Theme General Settings'),
        'menu_title'    => __('Theme Settings'),
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/////////////////////

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

/////////////////////
function scripts() {
	wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'scripts' );

function stylese() {
	//wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css');

	wp_deregister_style('font-awesome2');
	wp_deregister_style('wp-block-library');
}
add_action( 'wp_enqueue_scripts', 'stylese' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////// GET BLACK

function mg__get_green($text){
  $text = preg_replace(
    array(
      "/\[GREEN\](.*)\[\/GREEN\]/",
    ),
    array(
      "<span>$1</span>",
    ),
    $text
  );

  return $text;
}

/////// copy function

/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }
  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;
  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );

  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;

  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {
    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );

    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );

    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }

    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }

    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}

add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'rd_duplicate_post_link', 10, 2 );

// send


function send_phone(WP_REST_Request $request) {
  header("Access-Control-Allow-Origin: *");

  global $wpdb;
  global $post;

  $from_name = "noreply@seatback-admin.webbuilder.in.ua";

  if(!empty($request['data'])){
    $subject = 'Order from Seatback';
    $from_title = 'Order from Seatback';
    $message ='
      <html>
        <head>
          <title>'.$subject.'</title>
        </head>
        <body>';
    foreach($request['data'] as $key=>$value){
      $message.='<p>'.$key.': '.$value.'</p>';
    }
    $message .='
      </body>
    </html>';
    $headers = "From: ".$from_title." <".$from_name.">\r\n";
    $headers .= "Content-type: text/html; charset=utf-8 \r\n";
    $mails = get_field("emails",$request['id']);
    if(!empty($mails)){
      foreach($mails as $email){
        mail($email['email'], $subject , $message, $headers);
      }
    }


    $check_sender = get_field("sender",$request['id']);
    if(!empty($request['data']['Email']) && $check_sender){
      $text = get_field("email_text",$request['id']);
      $subject = get_field("subject_ec",$request['id']);
      $from_title = get_field("from_ec",$request['id']);
      $message ='
        <html>
          <head>
            <title>'.$subject.'</title>
          </head>
          <body>';
      $message.=$text;
      $message .='
        </body>
      </html>';
      $headers = "From: ".$from_title." <".$from_name.">\r\n";
      $headers .= "Content-type: text/html; charset=utf-8 \r\n";
      mail($request['data']['Email'], $subject , $message, $headers);
    }
  }

}

add_action( 'rest_api_init', function(){

  register_rest_route( 'seatback-api', '/send-forms/(?P<id>\d+)', [
    'methods'  => 'POST',
    'callback' => 'send_phone',
  ] );

} );


/////////// FORM

function forms() {

  $labels = array(
    'name'                  => _x( 'Forms', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Forms', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Forms', 'text_domain' ),
    'name_admin_bar'        => __( 'Forms', 'text_domain' ),
    'archives'              => __( 'Forms', 'text_domain' ),
    'attributes'            => __( 'Item Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
    'all_items'             => __( 'All', 'text_domain' ),
    'add_new_item'          => __( 'Add', 'text_domain' ),
    'add_new'               => __( 'Add', 'text_domain' ),
    'new_item'              => __( 'Add', 'text_domain' ),
    'edit_item'             => __( 'Edit', 'text_domain' ),
    'update_item'           => __( 'Update', 'text_domain' ),
    'view_item'             => __( 'View', 'text_domain' ),
    'view_items'            => __( 'View', 'text_domain' ),
    'search_items'          => __( 'Find', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in basket', 'text_domain' ),
    'featured_image'        => __( 'Featured image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items_list'            => __( 'Items list', 'text_domain' ),
    'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Forms', 'text_domain' ),
    'description'           => __( 'Forms', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'author' ),
    'taxonomies'            => array(  ),
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 55,
    'menu_icon'             => 'dashicons-text-page',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    'show_in_rest'          => true,
    //'rewrite'       => array('slug'=>"katalog")
  );
  register_post_type( 'forms', $args );

}
add_action( 'init', 'forms', 0 );

add_theme_support( 'menus' );