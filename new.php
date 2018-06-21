//for inserting data without using form
<?php

$website = "http://example.com";
$userdata = array(
    'user_login'  =>  'login_name',
    'user_url'    =>  $website,
    'user_pass'   =>  NULL  // When creating an user, `user_pass` is expected.
);

$user_id = wp_insert_user( $userdata ) ;

//On success
if ( ! is_wp_error( $user_id ) ) {
    echo "User created : ". $user_id;
}
?>
//post page check
<?php if(is_home()){} ?>

//display site title 
<?php echo get_bloginfo('name'); ?>

////display site tagline 
<?php echo get_bloginfo('description'); ?>

<?php
    function add_menuclass($ulclass) {
      return preg_replace('/<a /', '<a class="goto"', $ulclass);
    }
    add_filter('wp_nav_menu','add_menuclass');
?>

//category taxonomy check 
<?php if(is_category()){} ?>

//custom taxonomy check
<?php if(is_tax('taxonomy_name')){} ?>

//for breadcrumb
<div class="brdcrmb-area">
   <div class="container">
       <ul class="breadcrumb">
            <li><a href="<?php echo esc_url( home_url() ); ?>">Hem</a></li>
            <li><a href="<?php echo esc_url( home_url('/produkter') ); ?>">Produkter</a></li>
            <li class="active"><?php the_title(); ?></li>
       </ul>
   </div>
</div>

//for post type query
<?php
    $query1 = new WP_Query( array( 'post_type' => 'video','order' => 'ASC','posts_per_page' => '5','post_status' => 'publish'  ) );
        if ( $query1->have_posts() ) {
            while ( $query1->have_posts()) {
	            $query1->the_post();
            
 ?> 
 <?php } }  wp_reset_postdata(); wp_reset_query(); ?> 

else { ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p> <?php } ?>

//count total posts in a category
<?php 
    $catgory = get_queried_object();
    $total_posts = $catgory->count;
?>
<!-- time format  -->
<?php the_time('F j, Y'); ?> March 10,1994

//to get the featured image
<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" alt="" />

//ternary example
<a href="<?php echo (get_field('view_all_work_link',93)) ? get_field('view_all_work_link',93) : "javascript:void(0);" ?>"></a>

<?php 
 if ( has_post_thumbnail() ) { 
 $imagebg =  wp_get_attachment_url( get_post_thumbnail_id() );                             
} else{
    $imagebg= get_stylesheet_directory_uri().'/images/noimage.jpg';
}?>
<?php if ( has_post_thumbnail($post->ID) ) { the_post_thumbnail('full', array('class'=>'img-responsive'));} ?>
or <?php  array('class'=>'img-fluid'); ?>

<?php $img=wp_get_attachment_image_src(get_post_thumbnail_id(),'full'); ?>
<img src="<?php echo $img[0]; ?>" alt=""/>

//for post page
<?php $img=wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full'); ?>
<img src="<?php echo $img[0]; ?>" alt=""/>

//
<?php 
function pippin_get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
    return $attachment[0]; 
}
?>
<?php $img_id = pippin_get_image_id(get_field('banner_image')); ?>
<?php echo wp_get_attachment_image($img_id, 'full','',array("class"=>"img-responsive")); ?>

<style>
.img-responsive{
    height: auto !important;
    max-width: 100%;
}
</style>

<?php array(
    [0] => url,
    [1] => width</em>,
    [2] => height</em>,
    [4] => is_intermediate)
?>

    <img src="<?php the_post_thumbnail_url(); ?>" alt="">               // without parameter -> 'post-thumbnail'
    <img src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="">  // Thumbnail (default 150px x 150px max)
    <img src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="">     // Medium resolution (default 300px x 300px max)
    <img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="">      // Large resolution (default 640px x 640px max)
    <img src="<?php the_post_thumbnail_url( 'full' );  ?>" alt="">      // Full resolution (original size uploaded) 
    <img src="<?php the_post_thumbnail_url( array(100,100) ); ?>" alt="">  // Other resolutions

<?php the_post_thumbnail('case-thumb',array('class'=>'img-fluid')); ?>
<?php 
the_post_thumbnail( 'thumbnail' );     // Thumbnail (150 x 150 hard cropped)
the_post_thumbnail( 'medium' );        // Medium resolution (300 x 300 max height 300px)
the_post_thumbnail( 'medium_large' );  // Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
the_post_thumbnail( 'large' );         // Large resolution (1024 x 1024 max height 1024px)
the_post_thumbnail( 'full' );          // Full resolution (original size uploaded)
//With WooCommerce
the_post_thumbnail( 'shop_thumbnail' ); // Shop thumbnail (180 x 180 hard cropped)
the_post_thumbnail( 'shop_catalog' );   // Shop catalog (300 x 300 hard cropped)
the_post_thumbnail( 'shop_single' );    // Shop single (600 x 600 hard cropped)
 ?>
//to get post tags
<?php 
    $id=get_the_ID();
    $terms = wp_get_post_tags($id);   
    foreach($terms as $trm)
    {
        echo $trm->name;
    }
?>

global variables for woocommerce
<?php
    global $woocommerce;
    $product = new WC_Product(get_the_ID()); 
?>


//echo php version
<?php echo phpinfo(); ?>

//to get category for a post type
<?php 
    $terms = get_terms('video_cat');
    foreach ( $terms as $term ) 
    {?>
        <li><a href="<?php echo get_term_link($term -> slug, 'gen_subjects'); ?>"><?php echo $term->name; ?></a></li>
    <?php }
?>
<?php 
$post_tags = get_the_tags($post->ID); ?>
//to get the cat name of normal post
<?php
    $category = get_the_category($post->ID);
    echo $category[0]->cat_name;
?>
//display category id of a post
<?php 
    $id=get_the_ID(); 
    $categories = get_the_category();

    foreach($categories as $cat)
    {
        echo $cat->term_id;
    }
?>
//for getting tag of a custom post type
 <?php  
    global $post;
    $terms = wp_get_object_terms($post->ID,'video_tag');   
    foreach($terms as $trm)
    {
        echo $trm->name;
    }
?>
//display category of post from custom post type
<?php $rsrce_ctgry = get_the_terms( $post->ID , 'resource-category' ); 
    foreach ( $rsrce_ctgry as $rsrce_cat ) : ?>
        <h4><?php echo $rsrce_cat->name; ?></h4>
<?php endforeach; ?>

// rename category
<!-- Uncategorized ID is always 1 -->
<?php 
    wp_update_term(1, 'category', array(
      'name' => 'hello',
      'slug' => 'hello', 
      'description' => 'hi'
    ));
?>

//register a menu
<?php 
function custom_new_menu() {
 register_nav_menus(
   array(
     'my-custom-menu' => __( 'My Custom Menu' ),
     'extra-menu' => __( 'Extra Menu' )
   )
 );
}
add_action( 'init', 'custom_new_menu' );
?>
//for getting a field
<?php echo get_field('field_name'); ?>
<?php the_field('field_name'); ?>

//post type query for custom post taxonomy query
<?php
    $query1 = new WP_Query( 
        array( 
            'order' => ASC,
            'posts_per_page' => '5', 
            'post_type' => 'Video',
            'tax_query' => array( array(
                'taxonomy' => 'video_cat',
                'terms' => '5',
                'field' => 'term_id',
                'include_children' => true,
                'operator' => 'IN'
            ) ),
    ) );
    if ( $query1->have_posts() ) {
        while ( $query1->have_posts() ) {
            $query1->the_post();
?>
//write the code
<?php }
    } wp_reset_postdata();
?> 
//for hours ago
<?php
    $time = get_post_time("U", true, $post_id);
    $time = human_time_diff($time, current_time('timestamp')) . " ago";
    echo $time;
?>

//plugin shortcode call
<?php echo do_shortcode(''); ?>

<!-- for responsive css -->
<style>
/* for max-width */
@media (max-width: 1365px) { }
@media (max-width: 1199px) { }
@media (max-width: 991px) { }
@media (max-width: 767px) { }
@media (max-width: 640px) { }
@media (max-width: 568px) { }
@media (max-width: 480px) { }
@media (max-width: 420px) { }
@media (max-width: 360px) { }

 /* for min-width*/
@media (min-width: 768px) { }
@media (min-width: 992px) { }
@media (min-width: 1200px) { }
@media (min-width: 1366px) { }
@media (min-width: 1600px) { }
</style>

<!--loader-->
<div id="preloader"> 
   <div id="status">
       <span>
           <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" alt="">
       </span>
   </div>
</div>
<!--end loader-->

/page-loader js code/
<script>
$(document).ready(function(){
    $(window).on('load', function() { // makes sure the whole site is loaded 
        $('#status').fadeOut(); // will first fade out the loading animation 
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
        $('body').delay(350).css({'overflow':'visible'});
    });
});
</script>

/page-loader css code/
<style>
#preloader {
    position: fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    height: 100%;
    width: 100%;
    background-color:#f3f8f9;
    z-index:999;
}

#status {
    width: 100px;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%,-50%);
    -moz-transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    -o-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
    animation: blink-animation 0.8s infinite;
    -webkit-animation: blink-animation 0.8s infinite;
    -moz-animation: blink-animation 0.8s infinite;
    -ms-animation: blink-animation 0.8s infinite;
    -o-animation: blink-animation 0.8s infinite;
    transform-origin: 0 0;
    -webkit-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    -ms-transform-origin: 0 0;
    -o-transform-origin: 0 0;
}

@keyframes blink-animation {
    0% {
        transform: scale(.8) translate(-50%, -50%);
    }
    50% {
        transform: scale(1) translate(-50%, -50%);
    }
    100% {
        transform: scale(0.7) translate(-50%, -50%);
    }
}

@-webkit-keyframes blink-animation {
    0% {
        transform: scale(.8) translate(-50%, -50%);
    }
    50% {
        transform: scale(1) translate(-50%, -50%);
    }
    100% {
        transform: scale(0.7) translate(-50%, -50%);
    }
}
</style>
/*--end loader--*/

//forgot password wordpress
<?php 
if(isset($_POST['reset_submit'])){
    $frgt_email=$_POST['reset_eml'];
    $random_password=wp_generate_password(12,false);
    $user = get_user_by('email',$frgt_email);
    $update_user = wp_update_user( array (
      'ID' => $user->ID,
      'user_pass' => $random_password
    )
  );
    if( $update_user ) {
        $recipient1 = $frgt_email;
        $uid1 = md5(uniqid(time()));
        $subject1 = 'New Password Details :-';
        $body1 = '<strong>New Password : '.$random_password.'<br></strong>';
        $admin_eml1=get_option('admin_email');

        $headers1 = "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers1 .= 'From: Tramposaurus Treks <'. $admin_eml1 . ">\r\n" .
        'Reply-To: '. $admin_eml1 . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($recipient1, $subject1, $body1, $headers1);
    }
  }
?>
<input type="text" name="eml" id="eml" placeholder="Email Address">
<input type="password" name="pswrd" id="pswrd" placeholder="****">
<input type="checkbox" name="rembr_me" id="rembr_me">
//remember me code
<script>
$(document).ready(function() {
    var remember = $.cookie('rembr_me');
    if (remember == 'true') {
        var email = $.cookie('eml');
        var password = $.cookie('pswrd');
        // autofill the fields
        $('#eml').val(email);
        $('#pswrd').val(password);
        $('#rembr_me').prop("checked",true);
    }
});
</script>

//remove admin bar
<?php 
add_action('after_setup_theme', 'remove_admin_bar'); 
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}
?>

//redirect after logout
<?php
add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
    wp_redirect( esc_url(home_url('/')) );
    exit();
}
?>

//require in function
<?php require THEME_DIR_PATH . '/includes/jetpack.php'; ?>

<?php
if(isset($_GET['action']) && $_GET['action']=='logout'){
    wp_logout();
}
?>

//add currency after price woocommerce
<?php
function addPriceSuffix($format, $currency_pos) {
    switch ( $currency_pos ) {
        case 'left' :
            $currency = get_woocommerce_currency_symbol();
            $format = '%1$s%2$s&nbsp;' . $currency;
        break;
    }
    return $format;
}
add_action('woocommerce_price_format', 'addPriceSuffix', 1, 2);
?>

<?php wp_title( '|', true, 'right' ); ?>

//user email check in wordpress
<?php
add_action( 'wp_ajax_user_check', 'user_check' );
add_action( 'wp_ajax_nopriv_user_check', 'user_check' );

function user_check(){
    $a=$_POST['a'];
    $msg="";

    global $wpdb;
    $tableusr=$wpdb->prefix.'users';
    $usr_cunt = $wpdb->get_var( "SELECT COUNT(*) FROM wp_users WHERE user_email LIKE '%$a';" );
    if($usr_cunt>0){
        $msg=1;
    }else{
        $msg=0;
    }
    echo $msg;
    exit();
}
?>
//facebook share
<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink($post_id); ?>" target="_blank">
//creating a template
<?php /* Template Name: AboutPage */ get_header(); ?> <?php get_footer(); ?> <?php get_sidebar(); ?>
//creating template for single page
<?php /*Template Post Type: post, page, event*/ ?>
//display title
<?php the_title(); ?>
//while loop for content
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
//while loop for repeater    
<?php while(the_repeater_field('')): ?>
<?php while(the_flexible_field('')): ?>
    <?php the_sub_field(''); ?>
<?php endwhile; ?>

//post content
<?php $pg=get_post(); echo $pg->post_content;?>

//tab dynamic 
<ul class="nav nav-tabs">
<?php 
    $wrk_qry=new WP_Query(array('post_type' => 'works','order'  => 'ASC','posts_per_page' => '-1','post_status' => 'publish'));
    $f=1; while ($wrk_qry->have_posts()) { $wrk_qry->the_post(); 
?>
  <li class="nav-item">
    <a class="nav-link <?php if($f==1){ echo 'active'; } ?>" data-toggle="tab" href="#<?php echo(basename(get_permalink()) ); ?>"><?php the_title(); ?></a>
  </li>
   <?php $f++; } wp_reset_postdata();  
  echo '</ul><div class="tab-content">';
   $e=1; while ($wrk_qry->have_posts()) { $wrk_qry->the_post(); ?>
  <div class="tab-pane <?php if($e==1){ echo 'active'; } ?> container" id="<?php echo(basename(get_permalink()) ); ?>">
    <div class="slide_show_box">
    <?php while(the_repeater_field('school_logos')): ?>
      <div class="slide_itm_comp"><img src="<?php the_sub_field('skl_logo'); ?>" alt="" /></div>
    <?php endwhile; ?>
    </div>
  </div>
  <?php $e++; } wp_reset_postdata();  ?>



//get post slug in wp_query
<?php echo $post->post_name; ?>
<?php echo(basename(get_permalink()) ); ?>

//get post title of post page
<?php echo single_post_title(); ?>

//enable content editor in post page
<?php 
if( ! function_exists( 'fix_no_editor_on_posts_page' ) ) {

    /**
     * Add the wp-editor back into WordPress after it was removed in 4.2.2.
     *
     * @param Object $post
     * @return void
     */
    function fix_no_editor_on_posts_page( $post ) {
        if( isset( $post ) && $post->ID != get_option('page_for_posts') ) {
            return;
        }

        remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
        add_post_type_support( 'page', 'editor' );
    }
    add_action( 'edit_form_after_title', 'fix_no_editor_on_posts_page', 0 );
 }
?>

//array and object diff
<?php 
    //for array
    global $wpdb;

    $result = $wpdb->get_results ( " SELECT * FROM  $wpdb->posts WHERE post_type = 'page' " ,ARRAY_A );
    foreach ( $result as $page ){
       echo $page['ID'].' , ';
       echo $page['post_title'].'<br/>';
    }

    //for object
    $result = $wpdb->get_results ( " SELECT * FROM  $wpdb->posts WHERE post_type = 'page' " , OBJECT );
    foreach ( $result as $page ){
       echo $page->ID.' , ';
       echo $page->post_title.'<br/>';
    }
?>


//concat example
<?php echo "<img src='". get_stylesheet_directory_uri()."/images/client_bnr.jpg'".">"; ?>

//get image from array in acf pro
<?php 
$img=get_field('img'); ?>
<img src="<?php echo $img['url']; ?>" alt="">

//fields for user in admin panel
<?php $userr = $_GET['id']; or
    $userr = get_current_user_id()
?>
<?php while(the_repeater_field('week_1_grade', 'user_'. $userr)): ?>
    <?php the_sub_field('grade', 'user_'. $userr); ?>
<?php endwhile; ?>  
 
//for acf gallery
<?php 
$images = get_field('logo_gallery');
foreach( $images as $image ): ?>  
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
<?php endforeach; ?>


//page id for post page
<?php $page_id = get_option( 'page_for_posts' ); ?>
<?php 
$post = get_post($post->ID);
$title = apply_filters('the_title', $post->post_title);
$content = apply_filters('the_content', $post->post_content); ?>

//for flexible field
<?php
// check if the flexible content field has rows of data
if( have_rows('flexible_content_field_name') ):
     // loop through the rows of data
    while ( have_rows('flexible_content_field_name') ) : the_row();
        if( get_row_layout() == 'paragraph' ):
            the_sub_field('text');
        elseif( get_row_layout() == 'download' ): 
            $file = get_sub_field('file');
        endif;
    endwhile;
else :
    // no layouts found
endif;
?>

//add image size
<?php 
    add_action( 'after_setup_theme', 'agent_image_size' );
    function agent_image_size() {
        add_image_size( 'blog-thumb', '196', '198', true );
    } 
?>

//for tags in custom post type
<?php 
    global $post;
    $terms = wp_get_object_terms($post->ID,'video_tag');
    if(!empty($terms)){
?>
the code and
 <?php 
    global $post;
    $terms = wp_get_object_terms($post->ID,'video_tag'); 
    $tags = array();  
    foreach($terms as $trm)
    {
        $tags[] = '<a href="'.esc_url(get_tag_link($trm->term_id)).'">'.esc_html($trm->name).'</a>';

        $tags[] = '<a href="<?php echo esc_url(get_tag_link($trm->term_id)); ?>"><?php echo (esc_html($trm->name)); ?></a>';
    }
    echo implode(',',$tags); 
}
?>

//display all categories assigned to a post
<?php $blog_ctgry = get_the_category();
/*if (!empty($blog_ctgry))*/ 
$categoriess = array();
foreach ($blog_ctgry as $all_cat) { 
    $categoriess[] = '<a href="'.esc_url(get_category_link($all_cat->term_id)).'">'.esc_html($all_cat->name).'</a>';
} ?>
<h4><?php echo implode(' , ', $categoriess); ?></h4>

<script>
jQuery(document).ready(function($) {
});
</script>

<script>
    $(document).ready(function(){ 
        $(".dwn-arw").click(function(){ 
            $("html,body").animate({ 
              scrollTop:$("#sprt").offset().top
            },700); 
        }); 
    });
</script>
//display author name
<?php 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
echo $display_name;
?>
//to get tags from normal post
<?php 
    $id=get_the_ID();
    $terms = wp_get_post_tags($id); 
    if(!empty($terms)){
?>
the code and
<?php
    $tags = array();
    foreach($terms as $trm)
    {
        $tags[] = '<a href="'.get_tag_link($trm->term_id).'">'.$trm->name.'</a>';
    } 
    echo implode(',',$tags); 
}  
?>

//comments
<?php
    $post_id=get_the_ID();
    $comments_count = wp_count_comments($post_id); 
    echo $comments_count->total_comments;
?>


//no of views
      //in function page
<?php 
function fiftysix_postViews($post_ID) {
    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count'; 
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
    //If the the Post Custom Field value is empty. 
    if($count == ''){
        $count = 0; // set the counter to zero.
         
        //Delete all custom fields with the specified key from the specified post. 
        delete_post_meta($post_ID, $count_key);
         
        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count;
     
    //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);
         
        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
        return $count;
        }
        //In all other cases return (count) Views
        else {
        return $count;
        }
    }
}
?>
     //in page
<?php echo fiftysix_postViews(get_the_ID()); ?>


// to get tag link
<?php  echo get_tag_link($trm->term_id); ?>

//function for post type with cat and tag
<?php 
function custom_post_type2() {
$labels = array(
'name'                => __( 'Video' ),
'singular_name'       => __( 'Video' ),
'menu_name'           => __( 'Video'),
'parent_item_colon'   => __( 'Parent Video'),
'all_items'           => __( 'All Video' ),
'view_item'           => __( 'View Video' ),
'add_new_item'        => __( 'Add New Video' ),
'add_new'             => __( 'Add New' ),
'edit_item'           => __( 'Edit Video' ),
'update_item'         => __( 'Update Video' ),
'search_items'        => __( 'Search Video' ),
'not_found'           => __( 'Not Found' ),
'not_found_in_trash'  => __( 'Not found in Trash' ),
);

// Set other options for Custom Post Type

$args = array(
'label'               => __( 'video'),
'description'         => __( 'videos' ),
'labels'              => $labels,
// Features this CPT supports in Post Editor
'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields','post-formats','page-attributes','trackbacks'),
// You can associate this CPT with a taxonomy or custom taxonomy. 
'taxonomies'          => array( 'genres' ),
/* A hierarchical CPT is like Pages and can have
* Parent and child items. A non-hierarchical CPT
* is like Posts.
*/  
'hierarchical'        => false,
'public'              => true,
'show_ui'             => true,
'show_in_menu'        => true,
'show_in_nav_menus'   => true,
'show_in_admin_bar'   => true,
'menu_position'       => 30,
'menu_icon'           => 'dashicons-calendar-alt',
'can_export'          => true,
'has_archive'         => true,
'rewrite' => array('slug' => 'team'),
'exclude_from_search' => false,
'publicly_queryable'  => true,
'capability_type'     => 'post',
);
register_post_type( 'video', $args );
}
add_action( 'init', 'custom_post_type2', 0 ); ?>
<?php 
add_action( 'init', 'create_article_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_article_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'article-categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'article-category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search categories' ),
        'all_items'         => __( 'All article-categories' ),
        'parent_item'       => __( 'Parent article-category' ),
        'parent_item_colon' => __( 'Parent article-category:' ),
        'edit_item'         => __( 'Edit article-category' ),
        'update_item'       => __( 'Update article-category' ),
        'add_new_item'      => __( 'Add New article-category' ),
        'new_item_name'     => __( 'New article-category Name' ),
        'menu_name'         => __( 'article-category' ),
    );

    $args = array(
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'update_count_callback' => 'my_update_article_category',
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'article-category' ),
        'supports'              => array('thumbnail'),
    );

    register_taxonomy( 'article-category', array( 'articles' ), $args );
    
    }
    add_theme_support( 'post-thumbnails', array( 'post','articles' ) );
    
    function my_update_article_category( $terms, $taxonomy ) {
        global $wpdb;
        foreach ( (array) $terms as $term ) {
    
            $count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );
    
            do_action( 'edit_term_taxonomy', $term, $taxonomy );
            $wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
            do_action( 'edited_term_taxonomy', $term, $taxonomy );
        }
    }


//for tags
add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Video Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'video Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Video Tags' ),
    'popular_items' => __( 'Popular Video Tags' ),
    'all_items' => __( 'All Video Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Video Tags' ),
  ); 

    $args=array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'video_tag' ),
  );
  register_taxonomy( 'video_tag', array( 'video' ), $args );
} ?>
//for pagination
<?php    
    $paged1 = isset( $_GET['paged1'] ) ? (int) $_GET['paged1'] : 1;
    $paged2 = isset( $_GET['paged2'] ) ? (int) $_GET['paged2'] : 1; 
    $args = array (
        'post_type'  => 'video',  
        'showposts'=>3,
        'order'=>'ASC',
        'paged' => $paged1        
    ); 
    $my_query1 = new WP_Query( $args );   
?>
<?php  
    while($my_query1->have_posts())
    {
        $my_query1->the_post();
?>
//the code and
<?php } ?>

<div class="pagination">
    <?php $pag_args1 = array(
        'format'  => '?paged1=%#%',
        'current' => $paged1,
        'total'   => $my_query1->max_num_pages,
        'add_args' => array( 'paged2' => $paged2 ),
        'prev_text'  => __('&laquo; Previous'),  &nbsp
        'next_text' => __('&raquo; Next'),
    );
    echo paginate_links( $pag_args1 );?>
</div>

//to trim content 
<?php 
    $trim=get_the_content(); 
    $shortexcerpt = wp_trim_words( $trim, $num_words = 11, $more = ' [read more … ]' );
    echo $shortexcerpt;
?>
or 
<?php echo wp_trim_words(get_the_content(),10,' ... '); ?>
//to get post tags of custom type
<?php
    $tax_query = array(
    array(
        'taxonomy' => 'video_tag',
        "terms" => $tag_list,
        'field'    => 'slug',
        )
    );
    $query1 = new WP_Query( 
        array( 
            'order' => ASC,
            'posts_per_page' => '5', 
            'post_type' => 'video',
            'tax_query' => $tax_query
        ) );
        if ( $query1->have_posts() ) {
            while ( $query1->have_posts() ) {
                $query1->the_post();
?>

//for apply form
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Apply Here</h4>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode('[contact-form-7 id="373" title="Apply Form"]'); ?>
            </div>
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> -->
        </div>
    </div>
</div>

//to link another page
<?php echo esc_url(home_url('/about-us')); ?>

//for scrolling to a section
<script>
$(document).on('click','.goTo', function(event) {
    event.preventDefault();
    var target = "#" + this.getAttribute('data-go-to');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 1000);
});
</script>
//to get widget
<?php 
function socialmenu() {
    register_sidebar( array(
        'name'          => __( 'Footer Block Three', 'twentyseventeen' ),
        'id'            => 'footer_menu3',
        'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
        'before_widget' => '<ul>',
        'after_widget'  => '</ul>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

add_action( 'widgets_init', 'socialmenu' ); ?>
// in archieve page
<?php
    the_archive_title( '<h1 class="page-title">', '</h1>' );
    the_archive_description( '<div class="taxonomy-description">', '</div>' );
?>

//field
<?php the_field('fieldname'); ?>

//to get a map or iframe, img src not needed
<?php the_field('locate_us_on_map',5705); ?>

//get a page
<?php $query = new WP_Query('page_id=91');  ?>

<?php global $post; 
foreach(get_the_tags($post->ID) as $tag) ?>

//for repeater
<?php while( have_rows('') ): the_row(); ?>

<!-- image path --> 
<?php echo esc_url(get_template_directory_uri()); ?>/assets/
<?php echo THEME_DIR_URI .'/assets/images/inner_banner.jpg'; ?>
<?php echo THEME_DIR_URI; ?>/assets/images/inner_banner.jpg'; ?>
<?php bloginfo('template_directory'); ?>/assets/

//comment form
<?php
    $fields =  array(
              'author' =>
                '<div class="form-group"><input id="author" placeholder="Name" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' required /></div>',

              'email' =>
                '<div class="form-group"><input id="email" placeholder="Email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' required /></div>',

              'url' =>
                '<div class="form-group"><input id="url" placeholder="Url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" required /></div>',
            );
    $args = array(
              'id_form'           => 'commentform',
              'class_form'        => 'comment-form',
              'id_submit'         => 'submit',
              'class_submit'      => 'btnNormal btnRed',
              'name_submit'       => 'Post Comment',
              'title_reply_before'=> '<div class="addComment"><label>',
              'title_reply_after' => '</label></div>',
              'title_reply'       => __( 'Add Your Comments' ),
              'title_reply_to'    => __( 'Leave a Reply to %s' ),
              'cancel_reply_link' => __( 'Cancel Reply' ),
              'label_submit'      => __( 'Send' ),
              'format'            => 'xhtml',
              'fields'            => apply_filters( 'comment_form_default_fields', $fields ),
              'comment_field'     =>  '<div class="form-group chckTextearea"><textarea id="comment" name="comment" placeholder="Write a comment here" class="form-control" aria-required="true" required></textarea></div>',
              'must_log_in'       => '<p class="must-log-in">' .
                sprintf(
                  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                ) . '</p>',
              'logged_in_as' => '<p class="logged-in-as">' .
                sprintf(
                __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
                  admin_url( 'profile.php' ),
                  $user_identity,
                  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                ) . '</p>'           
            );

        comment_form($args, $post_id);
    ?>

<?php
    $pageid = get_the_ID();
    if( get_field('iconimage',$pageid) ): $count = 0;
        $post_meta = get_post_meta($pageid, 'iconimage', true);
        $counts = 0;
        if (is_array($flex_field_array)) 
        {
            $counts = count($flex_field_array);
        }
        while ( has_sub_field('iconimage',$pageid) ) : $count++;
            if( get_row_layout() == 'add_icon' ):
                $image = get_sub_field('image');
                $hoverimage = get_sub_field('hoverimage');
?>
    <li>
        <span><img src="<?php echo $hoverimage['url']; ?>" alt=""></span>
        <img src="<?php echo $image['url']; ?>" alt=""> 
    </li>
    <?php
        if(($count%6 == 0) && ($count<$counts)):
            echo "</ul></div><div class='item'><ul class='partner_area'>";
            endif;
        endif;
    endwhile;
endif;
    ?>


<div class="related-list">
    <?php  $tags = wp_get_post_tags($post->ID);
        $first_tag = $tags[0]->term_id;
        $args=array(
                'tag__in' => array($first_tag),
                'post__not_in' => array($post->ID),
                'posts_per_page'=>5,
                'post_type' => 'post'                           
        );
    $query1 = new WP_Query($args); ?>

<?php

list($width, $height, $type, $attr) = getimagesize("image_name.jpg");

echo "Image width " .$width;
echo "<BR>";
echo "Image height " .$height;
echo "<BR>";
echo "Image type " .$type;
echo "<BR>";
echo "Attribute " .$attr;

?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $folder = "uploads/";
        move_uploaded_file($file_temp, $folder.$file_name);
        $query = "INSERT INTO tbl_image(image) VALUES('$file_name')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) 
        {
            echo "<span class='success'>Image Inserted Successfully.
              </span>";
        }
        else 
        {
            echo "<span class='error'>Image Not Inserted !</span>";
        }
    }
?>

drop down category fetch
<select name="event-dropdown" class="selectpicker" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
   <option value=""><?php echo esc_attr(__('Select Category')); ?></option> 

   <?php 
       //$option = '<option value="' . get_option('home') . '/category/">All Categories</option>'; // change category to your custom page slug
       $categories = get_categories(); 
       foreach ($categories as $category) {
           $option .= '<option value="'.get_option('home').'/category/'.$category->slug.'">';
           $option .= $category->cat_name;
           //$option .= ' ('.$category->category_count.')';
           $option .= '</option>';
       }
       echo $option;
   ?>
</select>

//tor remove p from content
<?php remove_filter( 'the_content', 'wpautop' ); ?>

<?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?>

//for search bar in 404
<style>
    svg.icon.icon-search {
        height: 50px;
        display: none;
    }
</style>

<?php 
function footerlogo( $wp_customize ) {
$wp_customize->add_section( 'footer_logo' , array(
   'title'       => __( 'Footer Logo', 'themeslug' ),
   'priority'    => 32,
   'description' => 'Upload a logo to replace the default site name and description in the header',
) );


$wp_customize->add_setting( 'footer_logo' );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
   'label'    => __('Footer logo', 'themeslug' ),
   'section'  => 'footer_logo',
   'settings' => 'footer_logo',
) ) );
}
add_action( 'customize_register', 'footerlogo' ); 
?>
//customize code
<?php 
function social_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'example_section_one',
        array(
          'title' => 'Footer Copyright',
          'description' => 'Insert Footer Copyright Content',
          'priority' => 30,
        )
    );
    $wp_customize->add_setting(
      'footer_copyright'
    );
    $wp_customize->add_control(
      'footer_copyright',
        array(
          'label' => 'Footer copyright',
          'section' => 'example_section_one',
          'type' => 'textarea',
        )
    );
}
add_action( 'customize_register', 'social_customizer' ); ?>

<?php echo get_theme_mod(''); ?>

//image upload in php
<?php 
if(isset($_POST["submit"])){
    $image=$_FILES['img']['name'];
    $size=$_FILES['img']['size'];
    $tempname=$_FILES['img']['tmp_name'];
    list($width, $height, $type, $attr) = getimagesize($tempname);
    if($width==260 && $height==260){
        $name=time()."_".rand(00,99)."_".$image;
        $path="Upload/".$name;
        if(move_uploaded_file($tempname, $path)){
            echo "<br>"."Your file is succesfully update";
        }
        else{
            echo $_FILES['img']['error'];
        }
    }
    else {
        echo "Image dimantion does not match...";
    }
}
?>

<?php if ( has_post_thumbnail($post->ID) ) { ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail'); ?>
    <figure><img src="<?php echo $image[0]; ?>" alt="" /></figure>

//map script code
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaoa9WKRopuJsF-R2gMVSN_kPwUVL47aI"></script>
<script type="text/javascript">
(function($) {
    function new_map( $el ) {
        // var
        var $markers = $el.find('.marker');
        // vars
        var args = {
            zoom        : 20,
            center      : new google.maps.LatLng(0, 0),
            mapTypeId   : google.maps.MapTypeId.ROADMAP,
            scrollwheel : false,
            draggable: true
        };
        // create map               
        var map = new google.maps.Map( $el[0], args);
        // add a markers reference
        map.markers = [];
        // add markers
        $markers.each(function(){    
            add_marker( $(this), map );   
        });
        // center map
        center_map( map );
        // return
        return map;
    }
    function add_marker( $marker, map ) {
        // var
        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
        // create marker
        var marker = new google.maps.Marker({
            position    : latlng,
            map         : map
        });
        // add to array
        map.markers.push( marker );
        // if marker contains HTML, add it to an infoWindow
        if( $marker.html() )
        {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content     : $marker.html()
            });
            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }
    function center_map( map ) {

        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each( map.markers, function( i, marker ){

            var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

            bounds.extend( latlng );

        });

        // only 1 marker?
        if( map.markers.length == 1 )
        {
            // set center of map
            map.setCenter( bounds.getCenter() );
            map.setZoom( 16 );
        }
        else
        {
            // fit to bounds
            map.fitBounds( bounds );
        }

    }

    var map = null;
    $(document).ready(function(){
        $('.acf-map').each(function(){
            // create map
            map = new_map( $(this) );
        });
    });
})(jQuery);
</script>

<?php if($paged>1):?>
    <div class="prev_page nav_page slick-prev">
        <?php echo get_previous_posts_link('&lt; prev',$total_pages); ?>
        <!--  <a href="javascript:void(0)">&lt; prev</a>-->
    </div>
    <?php endif;?>
        <?php if($paged<$total_pages):?>
    <div class="next_page nav_page slick-next">
        <?php echo get_next_posts_link('next &gt;',$total_pages); ?>
        <!--  <a href="javascript:void(0)">next &gt;</a>-->
    </div>
<?php endif;?>

//footer logos
<?php
function themeslug_theme_customizer( $wp_customize ) {
  $wp_customize->add_section( 'themeslug_logo_section' , array(
   'title'       => __( 'Logo', 'themeslug' ),
   'priority'    => 30,
   'description' => 'Upload a logo to replace the default site name and description in the header',
) );
$wp_customize->add_setting( 'themeslug_logo' );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
   'label'    => __( 'Logo', 'themeslug' ),
   'section'  => 'themeslug_logo_section',
   'settings' => 'themeslug_logo',
) ) );
}
add_action( 'customize_register', 'themeslug_theme_customizer' );
?>
<?php if ( get_theme_mod( 'themeslug_logo' ) ) : ?>

<a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
<img src="<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>" 
alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>

<?php else : ?>
<?php endif; ?>

<?php 

function all_reaturedproducts(){
    $meta_query   = WC()->query->get_meta_query();
    $meta_query[] = array(
        'key'   => '_featured',
        'value' => 'yes'
    );
    $args = array(
        'post_type'     =>  'product',
        'stock'         =>  1,
        'posts_per_page'=> -1,
        'orderby'       =>  'date',
        'order'         =>  'DESC',
        'meta_query'    =>  $meta_query
    );
    $featured_product = new WP_Query( $args ); 
    ?>
    <!--popular product-->
        <div class="popular_slider_outr">
            <div class="popular_slider">
                <?php while ( $featured_product->have_posts() ) : $featured_product->the_post(); 
                  $post_id = get_the_id();
                  $pid = base64_encode($post_id);
                  $url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
                  global $product; 
                  ?>
                <div class="item">
                    <div class="popular_cell">
                        <div class="blue_overlay">
                            <div class="overlay_option">
                                <a href="<?php the_permalink(630); ?>?pid=<?php echo $pid; ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon2.png" alt=""></a>
                                <a href="<?php echo home_url('/alkaline-springs/'); ?>?add-to-cart=<?php echo $post_id; ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon3.png" alt=""></a>
                            </div>
                        </div>
                        <div class="tag"><span>new</span></div>
                        <p><?php the_title(); ?></p>
                        <div class="popular_pic"><img src="<?php echo $url; ?>" alt=""></div>
                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                </div>
                <?php endwhile; wp_reset_query(); ?>
            </div>
        </div>
    <!--end-->
<?php
} ?>

//--------------For popular post------------------

<?php
    function setPostViews($postID) {
        $countKey = 'post_views_count';
        $count = get_post_meta($postID, $countKey, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $countKey);
            add_post_meta($postID, $countKey, '0');
        }else{
            $count++;
            update_post_meta($postID, $countKey, $count);
        }
    }
    $popularpost = new WP_Query( array( 'post_type' => 'blog', 'posts_per_page' => 4, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
    while ( $popularpost->have_posts() ) : $popularpost->the_post();                    
?>
<?php 
add_action( 'wp_ajax_get_product_dropdown', 'get_product_dropdown' );
add_action( 'wp_ajax_nopriv_get_product_dropdown', 'get_product_dropdown' );

function get_product_dropdown(){
    $urls = $_REQUEST['url'];
    $value = array();
    $i=0;
    foreach($urls as $url){
        $value[$i]['title'] = get_the_title(url_to_postid($url));
        $value[$i]['thumbnail'] = get_the_post_thumbnail_url(url_to_postid($url), 'thumbnail');
        $value[$i]['permalink'] = site_url('/').'product-details/?pid='.base64_encode(url_to_postid($url));
        $i++;
    }
    echo json_encode($value);
    die();
} ?>
//remove paragraphs from content
<?php remove_filter('acf_the_content', 'wpautop' );?>
<?php add_filter('acf_the_content', 'wpautop' );?>

//get gallery of woocommerce product
<?php
  global $product;
  $attachment_ids = $product->get_gallery_attachment_ids();
  foreach( $attachment_ids as $attachment_id ) {
    echo $image_link = wp_get_attachment_url( $attachment_id );
}
?>

//mobile check
<?php wp_is_mobile(); ?>

<?php
function add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '',


function register_fields()
{
    register_setting('general', 'my_first_field', 'esc_attr');
    add_settings_field('my_first_field', '<label for="my_first_field">'.__('Phone Number' , 'my_first_field' ).'</label>' , 'print_first_field', 'general');
    
    register_setting('general', 'my_second_field', 'esc_attr');
    add_settings_field('my_second_field', '<label for="my_second_field">'.__('Site Email' , 'my_second_field' ).'</label>' , 'print_second_field', 'general');
}
function print_first_field()
{
    $value = get_option( 'my_first_field', '' );
    echo '<input type="text" id="my_first_field" name="my_first_field" value="' . $value . '" />';
}
function print_second_field()
{
    $value = get_option( 'my_second_field', '' );
    echo '<input type="text" id="my_second_field" name="my_second_field" value="' . $value . '" />';
}
add_filter('admin_init', 'register_fields');
?>
<?php 
add_filter( 'authenticate', 'wpse32218_check_for_key', 10, 3 );
function wpse32218_check_for_key( $user, $username, $password ){
    $user_obj = get_user_by('login', $username );

    if ($username!=''){
        $value = get_user_meta($user->ID, 'confirmed', true);
        if($value!=null){
            $user = new WP_Error( 'denied', __("<strong>ERROR</strong>: You need to activate your account.".$value."") );//create an error
            remove_action('authenticate', 'wp_authenticate_username_password', 20); //key found - don't proceed!
        }
    }
    return $user;
}
?>
//for custom widget create
<?php 
function custom_widget() {
    register_sidebar( array(
        'name'          => __( 'Footer Block One', 'twentyseventeen' ),
        'id'            => 'footer_menu1',
        'description'   => __( 'Add widgets here .', 'twentyseventeen' ),
        'before_widget' => '<ul class="footer_list">',
        'after_widget'  => '</ul>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'custom_widget' ); ?>

Call :  
<?php dynamic_sidebar('footer_menu1'); ?>

//for first space validation in contact form
<script type="text/javascript">
$("#msg-form").on("keypress", function(e) {
    if (e.which === 32 && !this.value.length) //for no space ommit !this.value
        e.preventDefault();
});
</script>

<?php 
function wpbsearchform( $form ) {

    $form = 
    '<div class="input_search">
        <form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
        <input type="text" placeholder="Suche..." class="inputClass" value="' . get_search_query() . '" name="s" id="s" />
        <input type="submit" id="searchsubmit" class="btn buttonSimple" value="'. esc_attr__('Suche') .'" />
        </form>
    </div>';

    return $form;
}
add_shortcode('wpbsearch', 'wpbsearchform');
?> 
<?php $terms = get_the_terms( $product_id, 'product_cat' ); 
    $termname = $terms[0]->slug; ?>
//for map sent in contact form
on_sent_ok:"location='https://goo.gl/maps/FPUTK3rQLcC2';"


<?php 
function test_init(){
    echo "<h1>This Is Custom Plugin!</h1>";
    echo "<h2>User</h2>";
/* global $current_user;
    get_currentuserinfo();

echo 'Username: ' . $current_user->user_login . "\n";echo "<br>";
echo 'User email: ' . $current_user->user_email . "\n";echo "<br>";
/*echo 'User first name: ' . $current_user->user_firstname . "\n";echo "<br>";
echo 'User last name: ' . $current_user->user_lastname . "\n";echo "<br>";*/
/*echo 'User display name: ' . $current_user->display_name . "\n";echo "<br>";
echo 'User ID: ' . $current_user->ID . "\n";*/
$blogusers = get_users( array( 'fields' => array( 'display_name' ) ) );
// Array of stdClass objects.
foreach ( $blogusers as $user ) {
echo '<span>' . esc_html( $user->display_name ) . '</span>'; echo '<br>';
} 

?>

//counter loop for printing first and last
<?php $count=0; while('the_field'): $count++; $orderng='get_field_value from radio button';?>
<?php if(($ordrng ==0)&&($count==1)): ?>
  <h3><?php the_field('new_customize_section_for_privacy_policy'); ?></h3>
<?php endif; ?>
<div class="term_row">
   <h2><?php echo $section_title; ?></h2>
   <?php echo $section_content; ?>
</div>
<?php if($count == $ordrng ): ?>
    
  <h3><?php the_field('new_customize_section_for_privacy_policy'); ?></h3>
<?php endif; ?>

global $LNG_DE;
    $LNG_DE = $dictionary;



//login,logout 
<div class="log_panel">
    <?php if ( is_user_logged_in() ) { ?>
     <a href="<?php echo get_permalink(woocommerce_get_page_id('myaccount')); ?>/customer-logout/"><?php _e('Logout','twentyseventeen'); ?></a>
    <?php }else{ ?>
     <a href="<?php echo get_permalink(woocommerce_get_page_id('myaccount')); ?>"><?php _e('Login','twentyseventeen'); ?></a>
     <a href="<?php echo home_url('/register/'); ?>"><?php _e('Signup','twentyseventeen'); ?></a> 
    <?php } ?>
</div>

//to display user avatar
<?php echo get_avatar( get_the_author_meta( 'ID' )); ?>

//get thumbnail image of product category
<?php 
    global $wp_query;

    // get the query object
    $cat = $wp_query->get_queried_object();

    // get the thumbnail id using the queried category term_id
    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 

    // get the image URL
    $image = wp_get_attachment_url( $thumbnail_id );         
?> 
<img src="<?php echo $image;?>" alt="">
//to get field from category woocommerce
<img src="<?php the_field('category_banner',$cat->taxonomy.'_'.$cat->term_id); ?>" alt="">


//change post name in admin panel
<?php 
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blogs';
    $submenu['edit.php'][5][0] = 'Blogs';
    $submenu['edit.php'][10][0] = 'Add Blogs';
    $submenu['edit.php'][16][0] = 'Blogs Tags';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Blogs';
    $labels->singular_name = 'Blogs';
    $labels->add_new = 'Add Blogs';
    $labels->add_new_item = 'Add Blogs';
    $labels->edit_item = 'Edit Blogs';
    $labels->new_item = 'Blogs';
    $labels->view_item = 'View Blogs';
    $labels->search_items = 'Search Blogs';
    $labels->not_found = 'No Blogs found';
    $labels->not_found_in_trash = 'No Blogs found in Trash';
    $labels->all_items = 'All Blogs';
    $labels->menu_name = 'Blogs';
    $labels->name_admin_bar = 'Blogs';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

?>
//for load more post
<script>
    +function($){
        var paged = 2;
        var total_page = <?php echo $total_pg;?>;
        $("#loadmore").click(function(){
            var data= { action: 'video_load_fun', 'paged' :parseInt(paged)+1 };
            jQuery.post(ajaxurl, data,function(response) {
                paged++;
                if(total_page<paged){
                    $('.text-view-more').remove();
                }
                $(response).appendTo('.append-case').fadeIn('slow');
                $(".various").fancybox({
                    'width'             : '75%',
                    'height'            : '75%',
                    'autoScale'         : false,
                    'transitionIn'      : 'none',
                    'transitionOut'     : 'none',
                    'type'              : 'iframe'
                });
            });
        });
    }(jQuery);  
</script>

// Dropdown toggle
<script>
$('.dropdown-toggle').click(function(){
  $(this).next('.dropdown').toggle();
});
 
$(document).click(function(e){
  var target = e.target;
  if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) 
  {
    $('.dropdown').hide();
  }
});
</script>



Client ID=81107s8wjwjg9x
Client Secret=Ch5EJTXL4h1cUoPy

//stop related youtube videos
https://www.youtube.com/embed/SyiwWRMoXXA?&rel=0

//include css and js in function.php
<?php 
add_action( 'wp_enqueue_scripts', 'exactus_stylesheet_scripts' );
function exactus_stylesheet_scripts() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'fonts-css', get_template_directory_uri().'/assets/css/fonts.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'font-awesome-min-css', get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'reset-css', get_template_directory_uri().'/assets/css/reset.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'slick-css', get_template_directory_uri().'/assets/css/slick.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'custom-css', get_template_directory_uri().'/assets/css/custom.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'developer-css', get_template_directory_uri().'/assets/css/developer.css', array(), '1.1', 'all' );
    wp_enqueue_style( 'responsive-css', get_template_directory_uri().'/assets/css/responsive.css', array(), '1.1', 'all' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri(). '/assets/js/jquery-1.11.3.js' , false, NULL, true );
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri(). '/assets/js/bootstrap.js' , array ( 'jquery' ), 1.1, true );
    wp_enqueue_script( 'jquery-placeholder-1-3-min-js', get_template_directory_uri(). '/assets/js/jquery.placeholder.1.3.min.js' , array ( 'jquery' ), 1.1, true );
    wp_enqueue_script( 'slick-js', get_template_directory_uri(). '/assets/js/slick.js' , array ( 'jquery' ), 1.1, true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri(). '/assets/js/custom.js' , array ( 'jquery' ), 1.1, true );
}
?>
//multiple class dynamic
<?php 
$count=0;
while (the_repeater_field('')) : $count++;
switch ($count) {
    case 1:
        $class= "frst";
        break;
    case 2:
       $class= "scnd";
        break;
    case 3:
        $class= "thrd";
        break;
    case 4:
        $class= "frth";
        break;
    case 5:
        $class= "fth";
        break;
    case 6:
        $class= "six";
        break;
    case 7:
        $class= "last";
        break;
}
?>
   //the structure
<?php endwhile; ?>

//pagination 
<?php
 $paged1 = isset( $_GET['paged1'] ) ? (int) $_GET['paged1'] : 1;
 $paged2 = isset( $_GET['paged2'] ) ? (int) $_GET['paged2'] : 1;

  $query = new WP_Query( 
                  array( 
                      'post_type' => 'post',
                      'order' => 'ASC',
                      'posts_per_page' => '3',
                      'post_status'=> 'publish',
                       'paged' => $paged1
                ) );
      if ( $query->have_posts() ) :
          while ( $query->have_posts() ) :
            $query->the_post();
?>
<ul class="pagination">
<?php 
    $pag_args1 = array(
    'format'  => '?paged1=%#%',
    'current' => $paged1,
    'total'   => $query->max_num_pages, 
    'add_args' => array( 'paged2' => $paged2 ),
    'prev_text'  => __(' Prv <span><img src="'.get_template_directory_uri().'/images/p_rrw-p.png" alt=""></span>'),
    'next_text' => __('<span><img src="'.get_template_directory_uri().'/images/p_rrw.png" alt=""></span> Next'),
    );
    
  echo paginate_links( $pag_args1 );?>
</ul>
//for tags by counting
<?php $tags = get_tags( array('orderby' => 'count', 'order' => 'DESC', 'number'=>28) ); foreach ( (array) $tags as $tag ) { echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '</a></li>'; } ?>

<a href="<?php echo esc_url(home_url('/login/')); ?>" class="<?php echo esc_url(home_url('/login/'))==get_the_permalink(get_the_ID())?'active':''; ?>"><?php echo get_theme_mod('login_title'); ?></a>
        <a href="<?php echo esc_url(home_url('/sign-up/')); ?>" class="<?php echo esc_url(home_url('/sign-up/'))==get_the_permalink(get_the_ID())?'active':''; ?> sign_up_hd"><?php echo get_theme_mod('signup_title'); ?></a>

//for showing value of select dropdown
<script>
+function($){
    $(document).ready(function(){
        $('#price-slct').change(function(){
            var end = $(this).find("option:selected").val();
            //alert(end);
            $('#shw-price').html(end);
            
        });
    });
}(jQuery);
</script>

//for stopping video in modal
<script>
$(document).ready(function(){
  $(".home-modal").on('hidden.bs.modal', function (e) {
    $(".home-modal iframe").attr("src", $(".home-modal iframe").attr("src"));
  });
}); 
</script>

// to stop autoplay and create autoplay put the link after iframe src and place the code 
?version=3&enablejsapi=1&autoplay=1
<script>
$(document).ready(function(){
    /* Get iframe src attribute value i.e. YouTube video url
    and store it in a variable */
  var videoSrc = $("#video_Modal iframe").attr("src");
  $("#video_Modal iframe").attr("src","");

  $('#video_Modal').on('show.bs.modal', function () { // on opening the modal
    // set the video to autostart
    $("#video_Modal iframe").attr("src", videoSrc+"&amp;autoplay=1");
  });

  $("#video_Modal").on('hidden.bs.modal', function (e) { // on closing the modal
    // stop the video
    $("#video_Modal iframe").attr("src", null);
  });
});
</script>

<a class="logout" href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
 
<?php 
    $query = new WP_Query( 'pagename=xyz' );
    while ( $query->have_posts() ) : $query->the_post(); 
?>

//for creating gallery in acf
<?php 
    $page_id=get_the_ID();
    $images=get_field('home_page_photo_gallary',4);                             
    foreach ($images as $img) :
?>

    <div class="col-xs-6 col-sm-4">
        <div class="gallery-inner-img">
            <a class="fancybox" href="<?php echo $img['url']; ?>" data-fancybox-group="gallery" ><span><i class="fa fa-search"></i></span><img src="<?php echo $img['url']; ?>" alt="" /></a>
        </div>
    </div>
<?php endforeach; ?>

//get attribute value and store in a hiden input
<script>
(function($){
    $(".project-type").click(function(){
        var project_type =$(this).attr('target-value');
        $("#project-type-1").val(project_type);
    });
})(jQuery);
</script>

<script>
(function($){  
   $(".submit-details" ).click(function() {
    var date = $(this).attr('data-date');
    var time = $(this).attr('data-time');
    var name = $(this).attr('data-name');
    var lastname = $(this).attr('data-lastname');
    var church = $(this).attr('data-church');
    $('#date_hidden').val(date);
    $('#time_hidden').val(time);
    $('#name_hidden').val(name);
    $('#last_name_hidden').val(lastname);
    $('#church_hidden').val(church);
   })
   $('.close').click(function(){
        window.location.href="";
    })
})(jQuery);
</script>

//ajax code for submit data
<script>
$.ajax({
    type: "POST",
    url: "ajax-submit2.php",
    data: dataString,
    cache: false,
    success: function(result){
        $("#msge").html(result);
        $("#name1").val('');
        $("#email1").val('');
        $("#phone1").val('');
        $("#message1").val('');
    }, 
    error: function(result){
       alert(result);
    },
});
</script>

//submit data and show message in ajax
<script>
$.ajax({
    type: "POST",
    url: "ajax-submit.php",
    data: dataString,
    cache: false,
    success: function(result){
        $("#msg").html(result);
        var xSeconds = 10000; // 1 second
        setTimeout(function() {
            $('#msg').fadeOut('slow');
        }, xSeconds);
    }, 
    error: function(result){
        alert(result);
    },
});
</script>


//ajax load more post
in function page
<?php 
add_action('wp_head','ajaxurl');
function ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

</script>
<?php }
add_action( 'wp_ajax_video_load_fun', 'video_load_fun');
add_action( 'wp_ajax_nopriv_video_load_fun', 'video_load_fun');
function video_load_fun(){
        $paged = $_REQUEST['paged'];
        $wpb_all_query = new WP_Query(array(
            'order'=>'DESC','post_type'=>'post', 'post_status'=>'publish', 'paged'=>$paged, 'posts_per_page'=>3)); 
        $total_pg = $wpb_all_query->max_num_pages;
        if ( $wpb_all_query->have_posts() ) : ?>
        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

            //the structure

        <?php  
        endwhile;  endif; 
        //die();
    }
?>

in normal page
<div class="row append-case">
<?php $seminar1 = array( 'post_type' => 'post', 'order' => 'DESC','posts_per_page' => -1); 
    $totalpage=query_posts($seminar1);  
    $wpb_all_query = new WP_Query(array('order'=>'DESC','post_type'=>'post', 'post_status'=>'publish', 'paged'=>1, 'posts_per_page'=>3)); 
    $total_pg = $wpb_all_query->max_num_pages;
    if ( $wpb_all_query->have_posts() ) : 
        while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

        //the structure
    <?php endwhile; endif; wp_reset_query();?>
</div>
<div class="btn_outr blog_btnprt">
    <a id="loadmore" href="javascript:void(0)" class="btn btn-default global_btn">View More News</a>
    <div class="connect_btn">
    </div>
</div>

js code
<script>
  +function($){
    var paged = 1;
    var total_page = <?php echo $total_pg;?>;
    var btn = $('.connect_btn').html();
    $("#loadmore").click(function(){
        $('.connect_btn').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
        var data= { action: 'video_load_fun', 'paged' :parseInt(paged)+1 };
        jQuery.post(ajaxurl, data,function(response) {
            paged++;
            if(total_page<=paged){
                $('#loadmore').remove();
            }
            $(response).appendTo('.append-case').fadeIn('slow');
            $('.connect_btn').html(btn);
        });
    });
  }(jQuery);  
</script>

<script>
$(document).on("change",'input[name="crse"]',function(){        
    if($('#crse-nrml').is(':checked')){
        var crse_nrm = $('#crse-nrml').val();
        $('#one_time_amount').val(crse_nrm);
    }else if($('#crse-vrfd').is(':checked')){
        var crse_vrfd = $('#crse-vrfd').val();
        $('#one_time_amount').val(crse_vrfd);               
    }
    else{
        var crse_schlrship = $('#crse-schlrship').val();
        $('#one_time_amount').val(crse_schlrship);
    }
});
</script>

<script>
$(function (){
    $("#name").on("keypress", function(e){
            if (e.which === 32 && !this.value.length) 
            e.preventDefault();
    });
});
</script>




//plugin check
<?php 
if(isset($content) && $content){
} ?>

my ip=http://10.0.0.229



<?php 
function themeName_customize_register( $wp_customize ) {

    // Add Settings
    $wp_customize->add_setting('customizer_setting_one', array(
        'transport'         => 'refresh',
        'height'         => 325,
    ));
    $wp_customize->add_setting('customizer_setting_two', array(
        'transport'         => 'refresh',
        'height'         => 325,
    ));

    // Add Section
    $wp_customize->add_section('slideshow', array(
        'title'             => __('Slider Images', 'name-theme'), 
        'priority'          => 70,
    ));    

    // Add Controls
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'customizer_setting_two_control', array(
        'label'             => __('Slider Image #1', 'name-theme'),
        'section'           => 'slideshow',
        'settings'          => 'customizer_setting_one',    
    )));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'customizer_setting_two_control', array(
        'label'             => __('Slider Image #2', 'name-theme'),
        'section'           => 'slideshow',
        'settings'          => 'customizer_setting_two',
    )));    
}
add_action('customize_register', 'themeName_customize_register');
?>
//create normal post type
<?php 
add_action( 'init', 'promoted_offers' );
    function promoted_offers() {
        register_post_type( 'promoted_offers',
            array( 
              'labels' => array(
              'name' => __( 'Promoted Offers' ),
              'singular_name' => __( 'Promoted Offers' )
            ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'promoted_offers'),
          'supports' => array( 'title', 'editor', 'thumbnail', 'revisions','featured', 'comments','excerpt' ),
        )
    );
}
?>

<style>
* {
    margin:0;
    padding:0;
    text-decoration:none;
}
img{
    height: auto;
    max-width: 100%;
    display: block;
}
</style>
//echo php variable in alert

<?php 
echo '<script>alert("' . $surname . '");</script>';
?>

//set featured image from front end wordpress
<?php 
    $lastInsertId = wp_insert_post($userdata);
    if (!function_exists('wp_generate_attachment_metadata')){
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }
    if ($_FILES) {
        foreach ($_FILES as $file => $array) {
            if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                return "upload error : " . $_FILES[$file]['error'];
            }
            $attach_id = media_handle_upload( $file, $lastInsertId );
        }     
    }
    if ($attach_id > 0){
       //and if you want to set that image as Post  then use:
       update_post_meta($lastInsertId,'_thumbnail_id',$attach_id);
    }
?>
echo '<script>alert(\''.$attach_id.'\');</script>';


//for datepicker
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <!-- Javascript -->
      <script>
         $(function() {
            $( "#datepicker-12" ).datepicker();
           
         });
      </script>
   </head>
   
   <body>
      <!-- HTML --> 
      <p>Enter Date: <input type = "text" id = "datepicker-12"></p>
   </body>
</html>

//for video
<video id="videobcg" preload="auto" autoplay="true" loop="true" muted="1">
    <source src="<?php the_field(''); ?>" type="video/mp4">
</video>

php code for scrolling to a section
<?php echo esc_url(home_url('/help-start/')); ?>#idname; 

<div class="AW-Form-2053719154"></div>
<script type="text/javascript">(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//forms.aweber.com/form/54/2053719154.js";;
fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "aweber-wjs-je05gd5t5"));
</script>


//for image show
<input id="avatarDp" type="file" name="photo" onChange="showPreview(this);">
<div id="imgTarget"></div>

<script type="text/javascript">
  function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $("#imgTarget").css('background', 'url('+e.target.result+')');
        }
    fileReader.readAsDataURL(objFileInput.files[0]);
    }
}
</script>

//for search
<form class="search_frm" action="<?php echo site_url(); ?>">
    <input type="text" name="s" placeholder="Search" class="search_inp" value="<?php echo $_GET['s']?$_GET['s']:''; ?>">
</form>

//for nav menu
<?php
    wp_nav_menu( array(
        'menu'              => 'top', // menu id like text_menu,site_menu...
        'theme_location'    => 'top',// menu id like text_menu,site_menu...
        'depth'             => 3,
        'container'         => 'div',
        'container_class'   => 'navbar-collapse collapse',   // div class
        'container_id'      => 'bs-example-navbar-collapse-1',
        'menu_class'        => 'nav navbar-nav navbar-right',  //ul or ol class
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker())
    );
?>
//in function
<?php 
    require_once 'wp-bootstrap-navwalker.php';
?>
//for typed js
<script>
    $("#element").typed({
        strings: ["text"],
        typeSpeed:100,
        backDelay:3000,
        loop:true,
        smartBackspace: true
    });
</script>

//header image code
<?php if ( get_header_image() ) : ?>
    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
<?php endif; ?>

<a href="<?php echo esc_url( home_url('/') ); ?>">
    <img src="<?php echo(get_header_image()); ?>" alt="">
</a>

//custom logo code
<?php if ( has_custom_logo() ) : ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
        <?php the_custom_logo(); ?>
    </a>
<?php endif; ?>

//logo code for img src
<?php 
    $custom_logo_id = get_theme_mod( 'custom_logo' ); 
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
    <img src="<?php echo $image[0]; ?>">

//background image code
<img src="<?php echo get_background_image(); ?>" alt="">

//for preg replace
<?php 
preg_replace('/[^0-9]/', '',$phone); ?>

<?php $phone=get_theme_mod('phone'); $tel=preg_replace('/[^0-9]/', '',$phone); ?>

<?php 
$seminar1 = array( 'post_type' => 'post', 'order' => 'DESC','posts_per_page' => -1); 
    $totalpage=query_posts($seminar1);  
        $wpb_all_query = new WP_Query(array('order'=>'DESC','post_type'=>'post', 'post_status'=>'publish', 'paged'=>1, 'posts_per_page'=>3)); 
            $total_pg = $wpb_all_query->max_num_pages;
        if ( $wpb_all_query->have_posts() ) : 
            while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
the structure

      <?php endwhile; endif; wp_reset_query();?>
<div class="btn_outr blog_btnprt">
    <a id="loadmore" href="javascript:void(0)" class="btn btn-default global_btn">View More Blog</a>
</div>

<script>
  +function($){
    var paged = 1;
    var total_page = <?php echo $total_pg;?>;
    var btn = $('.connect_btn').html();
    $("#loadmore").click(function(){
      $('.connect_btn').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
      var data= { action: 'video_load_fun', 'paged' :parseInt(paged)+1 };
      jQuery.post(ajaxurl, data,function(response) {
      paged++;
      if(total_page<=paged){
        $('#loadmore').remove();
      }
      $(response).appendTo('.append-case').fadeIn('slow');
      $('.connect_btn').html(btn);
      });
    });
  }(jQuery);  
</script>
 
 //add class using jquery
<script>
    +function($){
        $("li.nav-item a").addClass("nav-link");
    }(jQuery);
</script>

//add attribute in  jquery
<script>
    $(document).ready(function(){
        $("ul#menu-top-menu li:last-child a").attr("data-toggle", "modal");
        $("ul#menu-top-menu li:last-child a").attr("data-target", "#joinModal");
    });
</script>

//make tab panel dynamic
<div id="tab">
    <ul class="nav nav-tabs" role="tablist">
        <?php $loop = new WP_Query( array( 'post_type' => 'candidates', 'posts_per_page' => -1 ) ); 
        $counter = 0;
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $counter++;
        ?>
            <li role="presentation" class="post-<?php the_ID(); ?> <?=($counter == 1) ? 'active' : ''?>"><a href="#post-<?php the_ID(); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php the_title();?></a></li>
        <?php endwhile; wp_reset_query(); ?>
    </ul>
    <div class="tab-content">
        <?php
        $counter = 0;
        $loop = new WP_Query( array( 'post_type' => 'candidates', 'posts_per_page' => -1 ) );
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $counter++;
        ?>
            <div role="tabpanel" class="tab-pane <?=($counter == 1) ? 'active' : ''?>" id="post-<?php the_ID(); ?>"><?php the_content();?></div>
        <?php endwhile; ?>
    </div>
</div>

<table rules="all" style="border-color:rgb(102,102,102) ; border: 1px solid; width: 100%" cellpadding="10">
    <tbody>
        <tr style="color:#ddb263;font-size:14px;background-color:rgb(57,62,64);border:1px solid #000; font-weight:bold">
            <td colspan="2">Get in touch</td>
        </tr>
        <tr>
            <td><strong>Name: </strong></td>
            <td>[text-180]</td>
        </tr>
        <tr>
            <td><strong>Email: </strong></td>
            <td><a href="mailto:[email-348]" target="_blank">[email-348]</a></td>
        </tr>
        <tr>
            <td><strong>Message: </strong></td>
            <td>[textarea-942]</td>
        </tr>
    </tbody>
</table>

//for bootstrap modal
<a href="javascript:void(0)" data-toggle="modal" data-target="#video_Modal" class="play_btn">
<div class="modal fade" id="video_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $("input[name='crse']").change(function(){      
        var value= $('input[name=crse]:checked').val();
        $('#tot_amount').val(value);
        $('#one_time_amount').val(value);
    });    
});
</script>

//get all terms
<?php 
    $terms = get_terms( 'course_cat' , array(
        'orderby'    => 'count',
        'order'      =>'DESC',
        'number'     => '8',
        'hide_empty' =>false
    ) ); 
    foreach ($terms as $trm) {
    }
?>


<ul>                                    
    <?php  global $wpdb;                                    
        $term_ids = $wpdb->get_col("SELECT term_id FROM $wpdb->term_taxonomy INNER JOIN $wpdb->term_relationships ON $wpdb->term_taxonomy.term_taxonomy_id=$wpdb->term_relationship.term_taxonomy_id INNER JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->term_relationships.object_id WHERE DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= $wpdb->posts.post_date"); 
            if(count($term_ids) > 0)
            {                                                       
                $tags = get_tags(
                            array(  'orderby' => 'count',
                                    'order'   => 'DESC',                                                    
                                    'number'  => 9,                                                         
                                    'include' => $term_ids,                                                 
                            ));                             
                $count = 0;                                  
                foreach($tags as $termval): $count++;
                    if($count <= 8): ?>                                    
                        <li>
                            <a href="<?php echo get_tag_link($termval->term_id); ?>">    
                            <?php echo $termval->name; ?></a>                                    
                        </li>                                    
                    <?php else: ?>
                        <li>       
                            <a href="<?php echo get_permalink(2256); ?>">                                               <?php echo 'View All'; ?>                                        
                            </a>                                    
                        </li>                                    
                    <?php endif; ?>                                    
                <?php endforeach; 
            } 
            else
            {   
                echo 'No tags found';                                    
            }
    ?>                                
</ul>

//share in facebook,twitter,linkedln,google plus
<div class="social-blk">
     <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook','left=100,top=100,width=500,height=500,toolbar=1,resizable=0'); return false;" rel="nofollow" title="Share on Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
     <a href="http://twitter.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'Twitter','left=100,top=100,width=500,height=500,toolbar=1,resizable=0'); return false;" rel="nofollow" title="Share on Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
     <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" class="" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
     <a class="fbCust" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'Google Plus','left=100,top=100,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-envelope" aria-hidden="true"></i></a>
</div>
//add role 
<?php 
function add_roless() {
   add_role( 'subscriber_course', 'Course Subscriber', array(
        'read' => true, // True allows that capability
        'edit_posts' => true, // Allows user to edit their own posts
        'publish_posts'=>true, //Allows the user to publish, otherwise posts stays in draft mode
        'edit_published_posts'=>true,
        'upload_files'=>true,
        'delete_published_posts'=>true,
    ) );
}
add_action( 'init', 'add_roless' );
?>


<?php 
  global $current_user; 
  get_currentuserinfo(); 
  $usr=get_user_meta($current_user->ID);
  echo "<pre>";
    print_r($usr);
  echo "</pre>";
?>

 <a href="<?php echo wp_logout_url(); ?>">Logout</a>

<tr style="background: #fff;">
    <td>
        <table>
            <tr>
                <td style="padding:15px 15px 5px;">
                    <span style="font-size: 16px; color: #8e8e93;">Here are your login details:-</span>
                </td>
            </tr>
            <tr>
                <td style="padding:0 15px 5px;">
                    <span style="font-size: 16px; color: #8e8e93;">Username: '.$_POST['stripe_email'].'</span>
                </td>
            </tr>
            <tr>
                <td style="padding:0 15px 5px;">
                    <span style="font-size: 16px; color: #8e8e93;">Password: '.$user_pass.'</span>
                </td>
            </tr>
        </table>
    </td>
</tr>

<?php if(strtotime(date('d-m-Y')) <= strtotime(get_field('event_date'))) { ?>

<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    </style>
    <div id="mc_embed_signup">
        <form action="https://harborcottagehouseboats.us17.list-manage.com/subscribe/post?u=feb6e7180009321dcf62cff84&amp;id=489b1b42ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
                <div class="frm_outer clearfix">
                    <div class="input_bxx">
                        <input type="text" value="" name="MMERGE1" class="required input_loop" id="mce-MMERGE1" placeholder="Name">
                    </div>
                    <div class="input_bxx">
                        <input type="email" value="" name="EMAIL" class="required email input_loop" placeholder="Email" id="mce-EMAIL">
                    </div>
                </div>
                <div class="msg_bxx">
                    <textarea placeholder="Message" value="" name="MMERGE2" class="" id="mce-MMERGE2" placeholder="Message"></textarea>
                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response footform" id="mce-success-response" style="display:none"></div>
                </div>    
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_feb6e7180009321dcf62cff84_489b1b42ef" tabindex="-1" value="">
                </div>
                <div class="Button_outer clearfix">
                    <div class="sbmit_btn">
                        <input type="submit" value="Submit" name="subscribe" id="mc-embedded-subscribe" class="explore_btn">
                    </div>
                </div>
            </div>
        </form>
    </div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
<script type='text/javascript'>
(function($) {
    window.fnames = new Array(); 
    window.ftypes = new Array();
    fnames[1]='MMERGE1';
    ftypes[1]='text';
    fnames[0]='EMAIL';
    ftypes[0]='email';
    fnames[2]='MMERGE2';
    ftypes[2]='text';
}(jQuery));
var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->

<!--html form for mailchimp -->
<form>
    <div class="frm_outer clearfix">
        <div class="input_bxx">
            <input type="text" value="" class="input_loop" placeholder="Name"/>
        </div>
         <div class="input_bxx">
            <input type="email" value="" class="input_loop" placeholder="Email"/>
        </div>
    </div>
    <div class="msg_bxx">
        <textarea placeholder="Message"></textarea>
    </div>
    <div class="sbmit_btn">
        <input type="submit" value="Submit"  class="explore_btn"/>
    </div>
</form>

<div style="width: 100%; margin: 0 auto; vertical-align: middle; background-color:#A30234;padding-top: 12px;padding-bottom: 12px; ">              
    <table cellpadding="0" cellspacing="0" style="width:550px; verticle-align:middle; background-color:#FFFFFF;margin: 0 auto;">
        <tr>
           <td colspan="6" style="text-align:center;"><img src="http://ticenter.net/wp-content/uploads/2016/03/logo.png"></td>
        </tr>
        <tr>
           <td colspan="6" style="text-align:center;"><strong>Your Application is Successfull</strong></td>
        </tr>
        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
             <strong> Course Applied</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$_POST['title_crse'].'</p>
          </td>
        </tr>
        <tr>
           <td colspan="6" style="text-align:left;"><strong>Here are your login details:-</strong></td>
        </tr>
        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
             <strong>Email Address</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$_POST['stripe_email'].'</p>
          </td>
        </tr>
         <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
           <strong> Password</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$user_pass.'</p>
          </td>
        </tr>                       
    </table>                    
</div>




'<div style="width: 100%; margin: 0 auto; vertical-align: middle; background-color:#A30234;padding-top: 12px;padding-bottom: 12px; ">
                 
    <table cellpadding="0" cellspacing="0" style="width:550px; verticle-align:middle; background-color:#FFFFFF;margin: 0 auto;">
        <tr>
           <td colspan="6" style="text-align:center;"><img src="http://ticenter.net/wp-content/uploads/2016/03/logo.png"></td>
        </tr>
        <tr>
           <td colspan="6" style="text-align:center;"><strong>User Enrollment Details</strong></td>
        </tr>
        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
             <strong> Name</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$fullname.'</p>
          </td>
        </tr>

        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
             <strong>Email Address</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$_POST['stripe_email'].'</p>
          </td>
        </tr>
         <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
           <strong> Phone Number</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$phone.'</p>
          </td>
        </tr>
         
        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
            <strong> Applied Course</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$apld_crse.'</p>
          </td>
        </tr>
        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
            <strong> Paid Amount</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
            <p>'.$paid_amount.'</p>
          </td>
        </tr>
        <tr>
          <td width="10%" style=" padding:5px 20px 5px 20px;">
              <strong> Language</strong>
          </td>
           <td style=" padding:5px 20px 5px 20px;">
          <p>'.$language.'</p>
          </td>
        </tr>                        
    </table>                    
</div>';

<iframe id="vzvd-5725673" name="vzvd-5725673" title="vzaar video player" class="vzaar-video-player" type="text/html" width="768" height="432" frameborder="0" allowFullScreen allowTransparency="true" mozallowfullscreen webkitAllowFullScreen src="//view.vzaar.com/5725673/player"></iframe>

<style>
.ifrme-map{
    filter: grayscale(100%);
}
</style>

//for comments
<?php   
    if(comments_open()||get_comments_number()) :
        comments_template();
    endif; 
?>

<?php
    $fields =  array(
      'author' =>
        '<div class="form-group"><input id="author" placeholder="Name" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></div>',

      'email' =>
        '<div class="form-group"><input id="email" placeholder="Email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' /></div>',

      'url' =>
        '<div class="form-group"><input id="url" placeholder="Url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" /></div>',
            );
    $args = array(
              'id_form'           => 'commentform',
              'class_form'        => 'comment-form',
              'id_submit'         => 'submit',
              'class_submit'      => 'btnNormal btnRed',
              'name_submit'       => 'Post Comment',
              'title_reply_before'=> '<div class="addComment"><label>',
              'title_reply_after' => '</label></div>',
              'title_reply'       => __( 'Add Your Comments' ),
              'title_reply_to'    => __( 'Leave a Reply to %s' ),
              'cancel_reply_link' => __( 'Cancel Reply' ),
              'label_submit'      => __( 'Send' ),
              'format'            => 'xhtml',
              'fields'            => apply_filters( 'comment_form_default_fields', $fields ),
              'comment_field'     =>  '<div class="form-group chckTextearea"><textarea id="comment" name="comment" placeholder="Write a comment here" class="form-control" aria-required="true"></textarea></div>',
              'must_log_in'       => '<p class="must-log-in">' .
                sprintf(
                  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                ) . '</p>',
              'logged_in_as' => '<p class="logged-in-as">' .
                sprintf(
                __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
                  admin_url( 'profile.php' ),
                  $user_identity,
                  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                ) . '</p>'           
            );
    comment_form($args, $post_id);
?>

//change role name 
<?php 
function change_role_name_subscriber() {
    global $wp_roles;
    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();
    $wp_roles->roles['subscriber']['name'] = 'Student';
    $wp_roles->role_names['subscriber'] = 'Student';           
}
add_action('init', 'change_role_name_subscriber');
?>

//redirecting to home page from another page
<?php
    $a=home_url('');
    echo '<script type="text/javascript">window.location = "'.$a.'";</script>';
?>

//login redirect
<?php
function my_login_redirect( $url, $request, $user )
{
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) 
    {
        if( ($user->has_cap( 'administrator' )) || ($user->has_cap( 'editor' )) ) 
        {
            $url = admin_url();
        } 
        else 
        {
            $url = home_url('/members/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );
?>

//restrict admin access to certain role
<?php
function no_admin_accss(){
    $redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
    if (current_user_can('subscriber'))
        exit( wp_redirect( $redirect ) );
}
add_action( 'admin_init', 'no_admin_accss', 100 );
?>

//for twitter feeds
<?php
function custom_twitter_struc($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret,$username)
{
    // $consumerKey = "z1j9xKSlucUDWGtkRkpgUHnoE";
    // $consumerSecret = "G5lfNlrF3GtyAjBya5NyAfJ1tm5KY2QdHc4TPKPOwdzX2V8Xfi";
    // $accessToken = "813185551-kmozbH9c2xBY1cAzAr1n3a8MEl9N75Ku4e9wDBsg";
    // $accessTokenSecret = "IqW9w3XChVuvApi3gY3qsAgtvLIrzNXnulg2D1plEjdmu";
    // $username = "imsayantandutta";
    $maximum= '10';
    $caching = 60;
    $filename = basename(__FILE__, '.php').'.json';
    $filetime = file_exists($filename) ? filemtime($filename) : time() - $caching - 1;
    if (time() - $caching > $filetime) {
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $base = 'GET&'.rawurlencode($url).'&'.rawurlencode("count={$maximum}&oauth_consumer_key={$consumerKey}&oauth_nonce={$filetime}&oauth_signature_method=HMAC-SHA1&oauth_timestamp={$filetime}&oauth_token={$accessToken}&oauth_version=1.0&screen_name={$username}");
        $key = rawurlencode($consumerSecret).'&'.rawurlencode($accessTokenSecret);
        $author_signature = rawurlencode(base64_encode(hash_hmac('sha1', $base, $key, true)));
        $oauth_header = "oauth_consumer_key=\"{$consumerKey}\", oauth_nonce=\"{$filetime}\", oauth_signature=\"{$author_signature}\", oauth_signature_method=\"HMAC-SHA1\", oauth_timestamp=\"{$filetime}\", oauth_token=\"{$accessToken}\", oauth_version=\"1.0\", ";
        $curl_request = curl_init();
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, array("Authorization: Oauth {$oauth_header}", 'Expect:'));
        curl_setopt($curl_request, CURLOPT_HEADER, false);
        curl_setopt($curl_request, CURLOPT_URL, $url."?screen_name={$username}&count={$maximum}");
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl_request);
        curl_close($curl_request);
        file_put_contents($filename, $response);
    } else {
        $response = file_get_contents($filename);
    }
    //header('Content-Type: application/json');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s', $filetime).' GMT');
    $obj_all_json_data = json_decode($response);
    return $obj_all_json_data;
}
?>

<?php 
    $consumerKey = get_theme_mod( 'twitter_consumer_key' );
    $consumerSecret = get_theme_mod( 'twitter_consumer_secret_key' );
    $accessToken = get_theme_mod( 'twitter_access_token' );
    $accessTokenSecret = get_theme_mod( 'twitter_access_token_secret' );
    $username = get_theme_mod( 'twitter_username' );
    $all_feedsFrom_Twitter = custom_twitter_struc($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret,$username);
    foreach($all_feedsFrom_Twitter as $obj_all_data ):
        $tweeterFeed = $obj_all_data->text;                
?>
    <div class="twitter-item">
        <div class="twitter-item-hdr clearfix">
            <div class="lft-section">
                <div class="prof" style="background-image: url(<?php echo $obj_all_data->user->profile_image_url; ?>)">
                </div>
                <div class="prof-details">
                    <a href="javascript:void(0)"><?php echo $obj_all_data->user->name; ?></a>
                    <span>@<?php echo $obj_all_data->user->screen_name; ?></span>
                </div>
            </div>
            <div class="rht-section">
                <i class="fa fa-twitter"></i>
            </div>
        </div>
        <div class="twitter-item-btm">
            <p><?php echo $obj_all_data->text; ?></p>
        </div>
    </div>
<?php endforeach;?>

<?php global $wpdb;
    $tablename = $wpdb->prefix.'exam_table';
    $results = $wpdb->get_results( "SELECT * FROM $tablename WHERE User_Id = '$user';" );
?>

//get_result example
<?php 
$results = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."em_locations WHERE location_name='".$_POST['location_name']."' AND location_status='1' ORDER BY location_id ASC", ARRAY_A );

$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT );
?>

<script>
$(function() { 
    $(".howItNav li a ").on("click", function( e ) { 
        e.preventDefault(); 
        var target = "." + this.getAttribute('data-go-to'); 
        var hh = $('.howItNav').outerHeight(); 
        $('html, body').animate({ 
            scrollTop: $(target).offset().top - hh 
        }, 600);
    });
});
//console.log(target); $('.howItNav li').removeClass('active'); $(this).parent('li').addClass('active'); }); });
</script>

//scroll to a section 
<script>
+function($){
    $(".nwsltr_btn").click(function() {
       $('html, body').animate({
           scrollTop: $(".footer_upper").offset().top
       }, 1500);
    });
}(jQuery);
</script>

//scroll to top
<script>
+function($){
    $('.goto_section').click(function(){
       $("html, body").animate({ scrollTop: 0 }, 600);
       return false; 
    });
}(jQuery);
</script>

//scroll down menu
<script>
+function($){
    $('a[href*="#"]:not([href="#"])').click(function() {
        /* 
            a[href*=#] 
            get all anchors <a> that contains # in href but with:

            :not([href=#])
            exclude anchors with href exactly equals to #
        */
        $('body').removeClass('navbar-active');
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top -120
                }, 1000);
                return false;
            }
        }
    });
}(jQuery);
</script>

<script>
jQuery(document).ready(function($) {
    $('.menu-item > a').click(function() {
        if (location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'') && location.hostname == this.hostname){
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 40
                }, 900);
                return false;
            }
        }
    });
});
</script>

//////How to create a post and some field in the post by coding/////

<?php
if(isset($_POST['submit'])) {
    $userdata= array(
        'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
        'post_content'  => $_POST['post_content'],
        'post_status'   => 'publish',
        'post_author'   => 1
    );
    $thisid = wp_insert_post($userdata, true ); 
    if ( is_wp_error( $thisid ) ) {
        echo "Error";
    }
    else {
        $meta_table = $wpdb->prefix . 'postmeta';
        $wpdb->insert(  $meta_table, array( 
            'post_id' => $thisid, 
            'meta_key' => 'companyname',
            'meta_value' => $_POST['companyname']
        ));
        $wpdb->insert( $meta_table, array( 
            'post_id' => $thisid,
            'meta_key' => 'requermant',
            'meta_value' => $_POST['requermant'] 
        ));
        $wpdb->insert( $meta_table, array( 
            'post_id' => $thisid, 
            'meta_key' => 'companyaddress',
            'meta_value' => $_POST['companyaddress'] 
        )); 
    }
}
?>

//ajax in wordpress
https://www.makeuseof.com/tag/tutorial-ajax-wordpress/

/////database uses in wordpress///////
https://codex.wordpress.org/Class_Reference/wpdb  

https://designmodo.com/wpdb-object-wordpress/

//////How to fetch youtube video's comment/////

<?php
    $api="AIzaSyCmYdFiXWw8AFwxGuC4AoKFRMWkqj4-aBM";
    $videoid= $thumb->id;
     $url="https://www.googleapis.com/youtube/v3/commentThreads?key=".$api."&textFormat=plainText&part=snippet&videoId=".$videoid."&maxResults=1";
     $videocontent = file_get_contents($url);
     $content = json_decode($videocontent);

    ?>
    <div class="comment-section">
  <?php 
  foreach($content->items as $itm){
  ?>
  <div class="media">
    <div class="media-left">
      <img src="<?php echo $itm->snippet->topLevelComment->snippet->authorProfileImageUrl;?>" class="media-object" style="width:60px">
    </div>
    <div class="media-body">
      <h4 class="media-heading"><?php echo $itm->snippet->topLevelComment->snippet->authorDisplayName;?></h4>
      <p><?php echo $itm->snippet->topLevelComment->snippet->textOriginal;?></p>
    </div>
  </div>
  <?php }?>
</div>
//////////////////////////////////////////////////


//session code 
<?php 
function register_my_session() { 
    if( !session_id() ) { 
        session_start(); 
    } 
} 
add_action('init', 'register_my_session');
?>

//simple query example in wordpress
<?php 
    $user= get_current_user_id();
    $tablediplm = $wpdb->prefix.'diplm';

    $uni=implode(",",$_POST['uni']);
    $spe=implode(",",$_POST['spec']);
    $diplm =implode(",",$_POST['diplm']);
    $dip_yr=implode(",",$_POST['dipyr']);

    $diplma_cunt = $wpdb->get_var( "SELECT COUNT(*) FROM $tablediplm WHERE usr_id = '$user' ;" );
    if($diplma_cunt<1){
       $sqldiplm = "INSERT INTO $tablediplm (usr_id,uni,spe,diplm_nm,dip_yr) VALUES ('$user','$uni','$spe','$diplm','$dip_yr')";
       $wpdb->query($sqldiplm);
    }else{
        $sqldiplmup = "UPDATE $tablediplm SET uni='$uni', spe='$spe', diplm_nm='$diplm', dip_yr='$dip_yr' WHERE usr_id='$user'";
        $wpdb->query($sqldiplmup);
    }
?>


//Set the parent of Page 15 to Page 7.
<?php 
    $wpdb->query( $wpdb->prepare( " UPDATE $wpdb->posts SET post_parent = %d WHERE ID = %d AND post_status = %s",7, 15, 'publish' ) );
?>

///How to display viewers of a youtube video/////

<?php
$json = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails,statistics&id=".$videoid."&key=AIzaSyCmYdFiXWw8AFwxGuC4AoKFRMWkqj4-aBM");
     $jsonData = json_decode($json);
    $views=$jsonData->items[0]->statistics->viewCount; echo number_format($views); 
?>
///////////////////////////////////////////////

<!-- Change the wp-login logo -->
<?php 
function custom_loginlogo() {
    echo '<style type="text/css">
    h1 a {background-image: url("https://esolz.co.in/lab5/wordpress/football_ground/wp-content/uploads/2017/10/logo-1.png") !important; }
    </style>';
}
add_action('login_head', 'custom_loginlogo');
?>

<!-- for scrolling -->
<script>
$(document).ready(function (){
    $(".scroll-down").click(function (){
        alert();
        $('html, body').animate({
            scrollTop: $(".content-form").offset().top
        }, 2000)
    });
});
</script>

<script>
+function($){
    $('#text-7 .textwidget .text-center').html('<p><a href="https://www.yelp.com/biz/mesa-dental-san-diego-3" target="_blank" rel="noopener"><img src="http://www.mesadentalsd.com/wp-content/uploads/2018/02/Yelp-128.png" width="128" height="128"></a><a href="https://www.google.com/maps/place/Mesa+Dental/@32.8004284,-117.1600181,17z/data=!4m7!3m6!1s0x80dbffe2436d008b:0xcb444974f64733a8!8m2!3d32.8004284!4d-117.1578294!9m1!1b1" target="_blank" rel="noopener"><img src="http://www.mesadentalsd.com/wp-content/uploads/2018/02/9903.png"></a><a href="https://www.bbb.org/sdoc/business-reviews/dentistry-cosmetic/mesa-dental-family-cosmetic-dentistry-in-san-diego-ca-30003596" target="_blank" rel="noopener"><img src="http://www.mesadentalsd.com/wp-content/uploads/2018/02/BBB-128.png"> </a></p>');
}(jQuery);
</script>

<script>
+function($){
    $("#submit_rslt").click(function() {
        var totl_mrk= $( "input[name='totl_mrk']" ).val();
        var uid= $( "input[name='uid_fld']" ).val();
        var course= $( "input[name='course']" ).val();
        var data = { 
           'action': 'marks_insert', 
           'uid': uid,
           'marks': totl_mrk,
           'course': course
        };
        $.post('<?php echo admin_url( 'admin-ajax.php' );?>', data, function(response) {
            var i = response;
            if($.trim(i)==1 || $.trim(i)==2){
                $('#myModal1').modal('hide');
            }
        }); 
    });
}(jQuery);
</script>


<!-- To Start Plugin -->
<?php 
/*
  Plugin Name: Simple Plugin
  Plugin URI: ####
  Description: User registration
  Version: 1.0
  Author: Abhijoy Samaddar
  Author URI: ###
 */
?>

//code for password in htaccess
AuthType Basic
AuthName "Password Protected Area"
AuthUserFile /path/to/.htpasswd
Require valid-user

<?php 
    function skyverge_change_default_sorting_name( $catalog_orderby ) {
        $catalog_orderby = str_replace("Default sorting", "Our sorting", $catalog_orderby);
        return $catalog_orderby;
    }
    add_filter( "woocommerce_catalog_orderby", "skyverge_change_default_sorting_name" );
    function my_woocommerce_catalog_orderby( $orderby ) {    
        unset($orderby["price"]);
        unset($orderby["price-desc"]);    
        return $orderby;
    }
    add_filter( "woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20 ) 
?>

//for cookies
<?php 
if ( !isset($_COOKIE['sitename_newvisitor'])) {
    setcookie( 'sitename_newvisitor', 1, time()+3600*24*100); 
}
?>

<?php
  $cookie_name = "user";
  $cookie_value = "John Doe";
  if ($_COOKIE[$cookie_name]=="") { ?>    
    <script>
        jQuery(document).ready(function($){
            $('#homeModal').modal('show');                    
        })  
    </script>
<?php } ?>


/*---sticky nav---*/ 
<script>
    $(window).scroll(function(){ 
        if($(document).scrollTop()>50){ 
            $(".header").addClass("shrink"); 
        } 
        else { 
            $(".header").removeClass("shrink"); 
        } 
    }); 
</script>
/*--end---sticky nav---*/


//favicon code

<link rel="icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon.ico" type="image/x-icon">

//jquery validation using plugin
<?php 
wp_enqueue_script('validationjs',get_theme_file_uri( '/assets/js/jquery.validate.min.js' ), array( 'jquery' ), '1.0', true );
wp_enqueue_script('additional-validation-js',  'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/additional-methods.min.js', array( 'jquery' ), '1.0', true );
?>
//close modal and open new modal
<script>
$(function(){ 
    $('.regstr_btnn').click(function(){ 
        $('#joinModal').one('hidden.bs.modal', function(){ 
            $('#regModal').modal('show'); 
        }).modal('hide'); 
    }); 
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/additional-methods.min.js"></script>

<script type="text/javascript">
         + function($) {
             /*$(document).ready(function() {*/
                 $('#reg_form').validate({
                     keyup: true,
                     ignore: [],
                     groups: {
                          dateGroup: "sday smonth syear",           
                      },
                     rules: {
                         firstname: {
                             required: true,
                             pattern: /^[a-z ,.'-]+$/i,
                         },               
                         photo: {
                             required: true,
                             accept: 'png|jpg|jpeg'
                         },
                         age: {
                             required: true,
                             number: true,
                             max:100
                         },
                         insurance: {
                             required: true,
                             number: true
                         },
                         
                         pssport: {
                             required: true,
                             accept: 'png|jpg|jpeg'
                         },
                         cntct: {
                             required: true,
                             pattern: /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/
                         },
                         po_box: {
                             required: true
                         },
                         email_address: {
                             required: true,
                             email: true,
                             remote:{
                                 url:'https://esolz.co.in/lab5/wordpress/Tramposaurus_Treks/wp-admin/admin-ajax.php',
                                 type:'post',
                                 data:{
                                     action  : 'user_check',
                                     emle   : function(){
                                         return $('#emle').val();
                                     }
                                 }
                             }
                          },
                          
                          registrant:{
                              required: true,
                              accept: 'png|jpg|jpeg'
                          },
                          
                          tel: {
                             required: true,
                             pattern: /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/
                          }
                     },
                     
                     messages: {                       
                         firstname: {
                             required: "First name is Required!",
                             pattern: "Not a Valid First Name!"
                         },
                         photo: {
                             required: "Please upload your photo!",
                             accept: "Please upload in png/jpg/jpeg format"
                         },
                         age: {
                             required: "Age is Required!",
                             number: "Please enter only number!"
                         },
                         
                         insurance: {
                             required: "Insurance Number is Required!",
                             number: "Please enter a valid Insurance Number"
                         },
                         pssport: {
                             required: "Please upload the photo",
                             accept: 'Please upload in png/jpg/jpeg format'
                         },
                         cntct: {
                             required: "Telephone Number is Required!",
                             pattern:"Please follow this format, (111)-111-1111"
                         },
                         po_box: {
                             required: "PO Box is Required!"
                         },
                         email_address: {
                             required: "Email Address is Required!",
                             pattern: "Not a Valid email address",
                             remote: "Sorry, that email already exists."
                         },
                          registrant:{
                              required: "Please upload your signature",
                              accept: 'Please upload in png|jpg|jpeg format'
                          },
                          tel: {
                             required: "Emergency Contact Number is Required!",
                             pattern:"Please follow this format, (111)-111-1111"
                          }
                     },
                     errorPlacement: function(error, element) {
                        if (element.attr("name") == "photo" ){
                          error.insertAfter(".btm_upold");
                        }else {
                          if (element.attr("name") == "sday" || element.attr("name") == "smonth" || element.attr("name") == "syear" ) {
                            error.insertAfter(".select_holder");
                          }else {
                            error.insertAfter(element);
                          }
                        }
                     },/*
                     success:function() {
                        $(.fst).css('display','block');
                        $(.fst).html('Form Submitted');
                     }*/
                 });
                         
         }(jQuery);
  </script>

//duplicate email and username check validation
<?php 
add_action( 'wp_ajax_user_check', 'user_check' );
add_action( 'wp_ajax_nopriv_user_check', 'user_check' );
function user_check(){
    $exists = email_exists($_POST['emle']);
    $userexist = username_exists($_POST['usrnme']); //for username duplicate check
    if($exists){
        echo 'false';
    }else{
        echo 'true';
    }
    die(); 
}
?>

<!-- /*reset password*/ -->
<?php 
add_action( 'wp_ajax_resetpassword', 'resetpassword' );
add_action( 'wp_ajax_nopriv_resetpassword', 'resetpassword' );
function resetpassword(){
    $email  = $_POST['email'];
if(!empty($email)){
    //$email  = $_POST['resetemail'];
    $random_password=wp_generate_password(12,false);
    $user = get_user_by('email',$email);
    $update_user = wp_update_user( array (
      'ID' => $user->ID,
      'user_pass' => $random_password
    )
  );
    if( $update_user ) {
        $recipient1 = $email;
        $uid1 = md5(uniqid(time()));
        $subject1 = 'New Password!!';
        $homeurl=home_url('/');
        $body1 = '<strong>New Password : '.$random_password.'<br></strong><br> You can login with this temporary password. To change your password please click <a target="_blank" href="'.$homeurl.'wp-admin/profile.php">here</a>';
        $admin_eml1=get_option('admin_email');

        $headers1 = "MIME-Version: 1.0\r\n";
        $headers1 .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers1 .= "From: Tramposaurus Treks <no-reply@tramposaurustreks.com>\r\n" .
                     "Cc: abhijoy.samaddar@esolzmail.com"
                     "Reply-To: no-reply@tramposaurustreks.com\r\n" .
                     "X-Mailer: PHP/" . phpversion();
        mail($recipient1, $subject1, $body1, $headers1);
    }
  }
}
?>
<script>
+function($) {
    $('#reset_submit').click(function(){ 
        var resetemail = $('#reset_eml').val();
        var resetdata = { 
                'action': 'resetpassword',
                'email': resetemail,
            };
        $.post(ajaxurl, resetdata, function(response) {
            $('.resetokk span').html('<span style="color:#57d857;font-weight:bold;display:block;padding-top:10px;">Please check your inbox for new password.</span>');
            $('#reset_eml').val('');
            $('#reset_submit').attr('disabled','disabled');
            $('#reset_submit').addClass('btndis');
            setTimeout(function() {
                $('.resetokk span').html('');
            }, 3000);
        });
    });
}(jQuery);
</script>


<div class="contact_inner_full">
    <div class="field_item">
        <label>Email Address</label>
        <input type="text" id="reset_eml" name="reset_eml" placeholder="Enter Your Email Address" class="cus_inpt">
        <span class="error_txtft" style="color:red"></span>
        <input type="hidden" value="" id="err_cntt">
    </div>
    <div class="form_btn">
        <input type="submit" value="reset password" class="cust_frm btndis" name="reset_submit" id="reset_submit" disabled>
        <p class="resetokk"><span></span></p>
    </div>  
</div>
<!-- forgot email exists or not -->
<?php 
    add_action( 'wp_ajax_fgt_email', 'fgt_email' );
    add_action( 'wp_ajax_nopriv_fgt_email', 'fgt_email' );

    function fgt_email(){
        $e=$_POST['e'];
        $msgg="";

        global $wpdb;
        //$tableusrr=$wpdb->prefix.'users';
        if($e!=NULL){
        $usr_cuntt = $wpdb->get_var( "SELECT COUNT(*) FROM wp_users WHERE user_email LIKE '%$e';" );
        if($usr_cuntt==0){
            $msgg=0;
        }else{
            $msgg=1;
        }
        echo $msgg;
        //exit();
    }
    else{
        echo 'Email is required';
        //exit();
    }
    exit();
    }
?>
<script>
  $("#reset_eml").change(function(){
          var fgemail= $("#reset_eml").val();
          var btnok="";
          //console.log(btnok);
          var data = { 
               'action': 'fgt_email',
               'e': fgemail,
          };
          $.post(ajaxurl, data, function(response) {
          btnok=response;
          if(fgemail==''){
             $('#reset_submit').attr('disabled', 'disabled');
             $('.error_txtft').html("Email id is required");
             $('#reset_submit').addClass('btndis');

          }
          else if(btnok==0){
              $('.error_txtft').html("Email id doesn't exist.");
              $('#reset_submit').attr('disabled', 'disabled');
              $('#reset_submit').addClass('btndis');
              //$('#err_cntt').val(msgg);
          }else if(btnok==1){
          $('.error_txtft').html("");
          $('#reset_submit').removeAttr('disabled');
          $('#reset_submit').removeClass('btndis');
          }         
      });
    });
</script>


set timeout example
<script>
+function($) {
    $('#mc-embedded-subscribe').click(function(e) {
        setTimeout(function() {
            $('#mce-success-response').html('');
        },5000);
    });
}(jQuery);
</script>

//settimeout contact form message
<script>
    +function($) {
        $(document).ajaxComplete(function(){
            $('.wpcf7-mail-sent-ok').delay(5000).fadeOut('slow');
        });
    }(jQuery);
</script>

<?php
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer_logo.png) !important;
            padding-bottom: 14px !important;
            width: 231px !important;
            height: 100px !important;
            background-size: contain !important;
            background-position : center center !important;
        }
        .interim-login.login h1 a{
            width: 180px !important;
        }
         input#wp-submit {
            color: #fff;
            background: #1c8db0;
            font-size: 17px;
            padding: 2px 23px;
            height: 34px;
            border: none;
            box-shadow: none;
            text-shadow: none;
        }
        input#wp-submit:hover{
                background: #3f4b4e;
                color: #fff;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
?>

<?php 
  $trim=get_the_content(); 
  $shortexcerpt = wp_trim_words( $trim, $num_words = 11, $more = ' [read more … ]' );
  echo $shortexcerpt;
?>

<!-- for tab -->
<nav>
   <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a> 
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
   <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
   <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
   <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div>

<!-- hover nav function -->
<script>
    $.fn.hover_nav = function(w_width) { 
        var doc_width = $(document).width(); 
        if(doc_width >= w_width) { 
            console.log("Desktop Menu"); 
            $(this).hover(function() { 
                $(this).find('.dropdown-menu').stop(true, true).delay(50).slideDown(250); 
            }, 
            function() { 
                $(this).find('.dropdown-menu').stop(true, true).delay(50).slideUp(250); 
            }); 
        } 
        else { 
            console.log("Mobile Menu"); 
        } 
    }; 
    /*--call function--*/ 
    $('.ml-auto .dropdown').hover_nav(767); 
    $(window).resize(function(){ 
        $('.ml-auto .dropdown').hover_nav(767); 
    }); 
</script>
<!-- END-hover nav -->

<?php $cnt=1; 
    $artcle_args = array(
     'hide_empty'=> true,
     'orderby' => 'id',
     'taxonomy' => 'maps_cat'
    );
 $maps_cat = get_categories($artcle_args); //print_r($maps_cat);
 foreach($maps_cat as $map_cat) { ?>
      <li class="nav-item"><a class="nav-link <?php if($cnt==1) echo 'active'; ?>" data-toggle="tab" href="#<?php echo $cnt; ?>" role="tab"><?php echo $map_cat->name; ?><input type="hidden" class="slug" name="slug" value="<?php echo $map_cat->slug; ?>"></a></li>
 <?php $cnt++; } ?>


<!-- popular post -->
<?php 
 function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
} ?>
<?php 
    $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
    while ( $popularpost->have_posts() ) : $popularpost->the_post();
            the_title(); 
    endwhile;
?>

<script type="text/javascript">
    $("#drop").change(function(){
        var cat_id = this.value;
        var data = { 
            'action': 'post_catagory', 
            'cat_id': cat_id
        };
        $.post('<?php echo admin_url( 'admin-ajax.php' );?>', data, function(response) {        
            $('.total_news_holder').html(response);
        }); 
    });
</script>

//image upload in wordpress
<?php 
    require( dirname(__FILE__) . '/../../../wp-load.php' );
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $wordpress_upload_dir = wp_upload_dir();
    if($_FILES['photo1']){
        $file1 = $wordpress_upload_dir['path'] . '/' .$_FILES['photo1']['name'];
        $new_file_mime1 = mime_content_type( $_FILES['photo1']['tmp_name'] );
        $file_path1=$wordpress_upload_dir['url'] . '/' . basename( $file1 );
        /*$_SESSION['img1']=$file_path1;*/
        move_uploaded_file($_FILES['photo1']['tmp_name'], $file_path);
        if( move_uploaded_file( $_FILES['photo1']['tmp_name'], $file1 ) ) {
            $upload_id = wp_insert_attachment( array(
               'guid'           => $file1, 
               'post_mime_type' => $new_file_mime1,
               'post_title'     => preg_replace( '/\.[^.]+$/', '', $_FILES['photo1']['name'] ),
               'post_content'   => '',
               'post_status'    => 'inherit'
            ), $file1 );
            wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $file1 ) );
            $sqlprflimg1 = "UPDATE $tableprflimg SET url='$file_path1' WHERE usr_id='$user' AND imgtyp='1'";
            $wpdb->query($sqlprflimg1);
        }
    }
?>
<script type="text/javascript">
function showPreview12(objFileInput){
    if(objFileInput.files[0]){
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $(".igul6").css('background', 'url('+e.target.result+')');
        }
    fileReader.readAsDataURL(objFileInput.files[0]);
    }
}
</script>

Log out url in menu
http://111.93.181.155/lab5/wordpress/Tramposaurus_Treks/wp-login.php?action=logout


<?php 
 $admin_email=$from =$_POST['email'];
$to = get_option('admin_email');
//$to = 'barun.kantiroy@esolzmail.com';
$subject = 'New User Registered';
$Message = 'New User Registered In Your Site';
$message = "<h3>".$Message."</h3><br/>"."<b>Name:</b> ".$fname." ".$lname."<br/>"."<b>Telephone Number:</b> ".$phone."<br/>"."<b>Membership Amount:</b> ".$amount."<br/>"."<b>Email:</b> ".$email."<br/>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: SJS Alumni <'. $from . ">\r\n" .
   'Reply-To: '. $admin_email . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
    mail($to,$subject,$message,$headers);
?>

//append code jquery
<script>
+function($){
    $("ul.f-iphone.clearfix.group").append('<li class="f-box f4 animated fadeInRight visible" data-animation="fadeInRight" data-animation-delay="800"><div class="f-box-logo"><i class="fa fa-cloud-upload"></i></div><div class="f-box-head">Proprietary Database Access &amp; Search</div><div class="f-box-desc"></div></li>');
}(jQuery);
</script>

//custom gallery code
<?php 
$files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );   
foreach ( (array) $files as $attachment_id => $attachment_url ) {  
    echo wp_get_attachment_image( $attachment_id, $img_size ); 
}
?>

//google analytics code
<?php 
function hook_analytics(){
?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-64067944-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-64067944-1');
    </script>
    <?php
}
add_action('wp_head', 'hook_analytics');
?>

//change login logo wordpress
<?php 
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(https://nfbpasfl18.wpengine.com/wp-content/uploads/2018/04/logo.png) !important;
            padding-bottom: 14px !important;
            width: 231px !important;
            height: 100px !important;
            background-size: contain !important;
            background-position : center center !important;
        }
        .interim-login.login h1 a {
            width: 180px !important;
        }
        input#wp-submit {
            color: #fff;
            background: #FEBF0F;
            font-size: 17px;
            padding: 2px 23px;
            height: 34px;
            border: none;
            box-shadow: none;
            text-shadow: none;
        }
        input#wp-submit:hover{
            background:#F79419;
            color: #fff;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' ); 

// changing the logo link from wordpress.org to your site
function mb_login_url() {  
    return home_url(); 
}
add_filter( 'login_headerurl', 'mb_login_url' );

// changing the alt text on the logo to show your site name
function mb_login_title() { 
    return get_option( 'blogname' ); 
}
add_filter( 'login_headertitle', 'mb_login_title' );
?>

//dynamic div structure with ajax
<script type="text/javascript">
+function($){
  $('.ctegry').click(function(event){
      var category=$(this).attr('data-title');
      var data = {
          'action': 'cat_post',
          'category' :category
      };
      jQuery.post(ajaxurl, data, function(response) { 
          $('.add_row').html(response);
          //$(response).appendTo('.add_row').fadeIn('slow');
      });
  });
}(jQuery);
</script>

<section class="featured_section">
    <div class="container">
        <div class="featured_projects">
            <ul> 
            <?php 
                $args = array(
                    'hide_empty'=> true,
                    'order' => 'ASC',
                    'taxonomy' => 'category',
                    'parent'         => 1
                );
                $categories = get_categories($args);
                $cnt=1;
                foreach($categories as $category) { 
            ?>                                               
                <li class="cate_links">
                    <a href="javascript:void(0)" class="ctegry <?php if($cnt==1){ echo 'actve'; } ?>" data-title="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></a>
                </li>
            <?php $cnt++; } ?>
                
            </ul>
        </div>
        <div class="featured_inr">
            <div class="row add_row">
                
                
            <?php $blog_query = new WP_Query( 
                                    array( 
                                        'post_type' => 'post', 
                                        'posts_per_page'=> -1,                                          
                                        'order' => 'DESC', 
                                        'cat' =>1,
                                        /*'tax_query' => array(array(
                                            'taxonomy' => 'projects_cat',
                                            'terms' => 21,
                                            'field' => 'term_id'
                                            
                                        )),*/
                                    )
                                ); 
                        if ( $blog_query->have_posts() ) :
                            while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                                $dt = get_the_date('F-d-Y');   
                                $date = explode("-", $dt);
            ?>
                //the structure
                <?php endwhile; wp_reset_postdata(); endif; ?> 
            </div>
        </div>
    </div>
</section>

and in function page
<?php 
add_action('wp_head','ajaxurl');
function ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

</script>


<?php }
add_action( 'wp_ajax_etf_post', 'etf_post' );
add_action( 'wp_ajax_nopriv_etf_post', 'etf_post' );

function etf_post(){
    $cat=$_REQUEST['category'];
    $blog_query = new WP_Query( 
                    array( 
                        'post_type' => 'post', 
                        'posts_per_page'=> -1,                                          
                        'order' => 'DESC', 
                        'cat' =>$cat
                        /*'tax_query' => array(array(
                            'taxonomy' => 'projects_cat',
                            'terms' => $cat,
                            'field' => 'term_id'
                            
                        )),*/
                    )
                ); 
                if ( $blog_query->have_posts() ) :
                    while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                            
                            $dt = get_the_date('F-d-Y');   
                            $date = explode("-", $dt);
                            ?>
    //the structure
    <?php endwhile; wp_reset_postdata(); endif; 
    die;
}


/**
  sign up
*/
add_action( 'wp_ajax_signup', 'signup' );
add_action( 'wp_ajax_nopriv_signup', 'signup' );
function signup(){
    $name  = $_POST['nme'];
    $useremail  = $_POST['emle'];
    $password  = $_POST['psword'];
    global $wpdb, $PasswordHash, $current_user, $user_ID;
    //if(isset($_POST['reg_submit'])) {
    $usrnme = $wpdb->escape(trim($name));
    $emle   = $wpdb->escape(trim($useremail));
    $psword = $wpdb->escape(trim($password));
    // $cnf_pswrd = $wpdb->escape(trim($_POST['cnf_pswrd']));
    $user_id = wp_insert_user( array (
        'first_name' => $usrnme, 
        'user_login' => $usrnme,
        'user_email' => $emle,
        'user_pass' => $psword, 
        'role' => 'subscriber' 
    ) );  
    $success = 'Registration Confirmed!!';
    $recipient = $emle;
    $uid = md5(uniqid(time()));
    $subject = 'Registration Confirmed!!';
    $body = '<strong>Name : '.$usrnme.'<br>Email : '.$emle.'<br>Password : '.$psword.'</strong>';
    $admin_eml=get_option('admin_email');

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: NFBPA <abhijoy.samaddar@esolzmail.com>\r\n".
                "Reply-To: abhijoy.samaddar@esolzmail.com\r\n" .
                'X-Mailer: PHP/' . phpversion();
    mail($recipient, $subject, $body, $headers)
    do_action('user_register', $user_id);     
}
?>

<script>
+function($){
    $('#payform').validate({
        keyup: true,
        rules: {
            nme: {
               required: true,
           },               
           emle: {
               required: true,
               email: true,
               pattern:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
           },
           psword: {
               required: true,
               minlength:8,
               maxlength:12
           },
         },
         messages: {
             nme: {
                 required: "Name is required.",
             },
             emle: {
                 required: "Email is required.",
                 email: "Please enter a valid email.",
                 pattern: "Not a valid email pattern."
             },
             psword: {
                 required: "Password is required.",
                 minlength:"Password must be 8 characters long.", 
                 maxlength: "Password shouldn't contain more than 12 characters."
             },
        },
        submitHandler: function(form, e) {
            if(!$('#payform').hasClass('validated')){ 
                var signupname=$('#nme').val(); 
                var signupemail = $('#emle').val();
                var signuppass=$('#psword').val();
                var signupdata = { 
                   'action': 'signup',
                   'nme':signupname,
                   'emle': signupemail,
                   'psword':signuppass,
                };
                $.post('<?php echo admin_url( 'admin-ajax.php' );?>', signupdata, function(response) {
                    $('#payform').addClass('validated');
                    $(form).submit();
                    $('.resetok span').html('<span style="color:#57d857;font-weight:bold;">Congratulation!!! You have successfully signed up.</span>');
                    setTimeout(function() {
                        $('.resetok span').html('');
                    }, 10000);
                }); 
            }
        }
    });
}(jQuery);
</script> 


<?php 
    $nav = wp_get_nav_menu_items( 'Top Menu' );
    foreach($nav as $nv):
?>
    <a href="<?php echo $nv->url;?>" class="page-scroll waves-effect"><i class="<?php echo implode(" ",$nv->classes);?>"></i><span><?php echo $nv->post_title;?></span></a>
<?php endforeach; ?>

<!-- Recent comments -->
<?php 
    $args = array( 
        'post_type' => 'post', 
        'number' => 3,
        'orderby' => 'date',
        'order' => 'DESC' 
    );
    $comments = get_comments($args); 
    foreach($comments as $comment) : 
        echo $comment->comment_author.' : '.$comment->comment_content;
    endforeach;
?>

//php database connect in oop
<?php 
    class Database{
        private $host;
        private $user;
        private $pass;
        private $db;
        public $mysqli;

        public function __construct() {
            $this->db_connect();
        }

        private function db_connect(){
            $this->host = 'localhost';
            $this->user = 'root';
            $this->pass = '';
            $this->db = 'db';
            $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
            return $this->mysqli;
        }

        public function db_num($sql){
            $result = $this->mysqli->query($sql);
            return $result->num_rows;
        }
    }
    $db = new Database();
    $db->db_num("SELECT fields FROM YourTable");
?>

//for password protect page
<?php 
    global $post; 
    if ( !post_password_required($post) ) { ?>
        <h4>Password Required</h4>
    <?php } else{ 
    $post = get_post($post);
    $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID ); ?>
        <form action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>" class="post-password-form" method="post"> 
            <label>Enter Access Code<span>*</span></label>
            <input name="post_password" id="<?php echo $label; ?>" placeholder="Enter your access code" type="password" size="20" />    
            <input type="submit" name="Submit" class="btn_dflt">    
        </form>
<?php } ?>

//remove cache from site
add plugin -> https://wordpress.org/plugins/comet-cache/
<?php 
    //add this code in wp-config.php
    define('WP_CACHE', true );
    define('DONOTCACHEPAGE', true);
    define('COMET_CACHE_ALLOWED', true);

    //add this code in function

    //this at the top
    comet_cache::version();
    comet_cache::options();
    comet_cache::clear();
    comet_cache::wipe();
    comet_cache::purge();

    add_action( 'save_post', 'my_custom_clear_cache', 10, 1 );
    function my_custom_clear_cache( ) {
        comet_cache::clear();
    }
    add_action( 'save_post_my-custom-post-type', 'clear_cache_for_page_id', 10, 1 );
    function clear_cache_for_page_id( ) {
        comet_cache::clearPost(get_the_ID()); // Clears cache for Post ID 5
    }
?>

<!-- html to wordpress -->
1. folder permisssion
2. css,js,images -> replace
3. style.css -> edit
4. header.php -> replace 
5. footer.php -> replace
6. front-page.php -> replace
7. css, js enqueue in function.php
8. home page set
9. images path set
10.permalink & htaccess set
11.screenshot.png -> replace

<?php  
    wp_editor($mail_content, "msg",array('wpautop'=>false,'media_buttons' => true)); 
?>

//mail function in php
<?php
$to = '';
$subject = '';
$message = '';
$headers = 'From: '.$frmname.'<'.$frmemail.'>.' . "\r\n" .
           'Reply-To: '.$frmemail.'.' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>

//same height js
<script>
    $(document).ready(function(){ 
        $('.container').each(function(){
            var highestBox = 0; 
            $('.career_info_box_bg', this).each(function(){ //career_info_box_bg===class name
                if($(this).height() > highestBox) { 
                    highestBox = $(this).height(); 
                } 
            }); 
            $('.career_info_box_bg',this).height(highestBox); 
        }); 
    }); //career_info_box_bg===class name
</script>

//woocommerce cart update ajax
<?php echo WC()->cart->get_cart_contents_count(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    jQuery(document).ready( function($) {

   $(".user_vote").click( function(e) {
      e.preventDefault(); 
      post_id = jQuery(this).attr("data-post_id")
      nonce = jQuery(this).attr("data-nonce")

      $.ajax({
         type : "post",
         dataType : "json",
         url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
         data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
         success: function(response) {
            if(response.type == "success") {
               $("#vote_counter").html(response.vote_count)
            }
            else {
               alert("Your vote could not be added")
            }
         }
      });   

   });

});
</script>

/**
 * Adds WooCommerce support
 */
<?php 
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'init', 'my_script_enqueuer' );

function my_script_enqueuer() {
 
   wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'my_voter_script' );

}
add_action("wp_ajax_my_user_vote", "my_user_vote");
add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");

function my_user_vote() {

   if ( !wp_verify_nonce( $_REQUEST['nonce'], "my_user_vote_nonce")) {
      exit("No naughty business please");
   }   

   $vote_count = get_post_meta($_REQUEST["post_id"], "votes", true);
   $vote_count = ($vote_count == '') ? 0 : $vote_count;
   $new_vote_count = $vote_count + 1;

   $vote = update_post_meta($_REQUEST["post_id"], "votes", $new_vote_count);

   if($vote === false) {
      $result['type'] = "error";
      $result['vote_count'] = $vote_count;
   }
   else {
      $result['type'] = "success";
      $result['vote_count'] = $new_vote_count;
   }

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}

function my_must_login() {
   echo "You must log in to vote";
   die();
}
?>

//comment structure
<!-- https://wp-ecommerce.net/easy-wordpress-smtp-send-emails-from-your-wordpress-site-using-a-smtp-server-2197#comment-31580 -->

//check uncnheck radio in jquery
<script>
$(function(){
    $('.radio input[type="radio"]').click(function() {
        if ($("#cemetery1").is(':checked')) {
            $(".datum-cstm").hide();
            $('.redan').show();
            $('#grav1,#grav2,#grav3').prop('checked', false);
        }
        else{
            $(".datum-cstm").show();
            $('.redan').hide();
            $('#redan1,#redan2,#redan3,#redan4').prop('checked', false);
        }
    });
});
</script>

//checkbox validation jquery plugin
<script>
$(document).ready(function () {
    $('#formid').validate({
        rules: {
            'test[]': {
                required: true,
                maxlength: 2
            }
        },
        messages: {
            'test[]': {
                required: "You must check at least 1 box",
                maxlength: "Check no more than {0} boxes"
            }
        }
        errorPlacement: function(error, element) {
            if ( element.is(":checkbox") ) {
                error.appendTo( element.parents('.container') );
            }
            else { // This is the default behavior 
                error.insertAfter( element );
            }
        }
    });
});
</script>

//setting your cookies there

<?php
function set_new_cookie() {
    if(!session_id()){
        session_start();
    }
    $cookie_name = "butterbrand";
    $cookie_value = 1;
    if(isset($_COOKIE['butterbrand'])):
        $_SESSION['butterbrand']=1;
    else:
        unset($_SESSION);
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    endif;
}
add_action( 'init', 'set_new_cookie');
?>


<?php if(!isset($_SESSION['digitall'])): ?>
    <!-- The Modal -->
    <div class="modal welcome fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body welcome_body">
                <div class="input_container">
                  <div class="chk_con noselect">
                    <label class="chk-check bg">
                      <input type="checkbox" name="chk">
                      <span></span> </label>
                    <div class="chck_cnt">
                        <?php the_field('cookie_modal_content'); ?>
                    </div>
                  </div>
                  </div>
                </div>
              <div class="modal-footer welcome_footer">
                <button type="button" class="btn btn-basic home_continue" disabled>
                  continue <span><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/submit-arrow.png" alt=""></span>
                </button>
              </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
+function($){
    $("#myModal").modal({backdrop: false});
    $('input[type="checkbox"]').click(function(){
        if($(this).is(":checked")){
            $('.home_continue').attr("data-dismiss", "modal");
            $('.home_continue').prop('disabled',false);
            $('.home_continue').css('cursor', 'pointer');
        }
        else if($(this).is(":not(:checked)")){
            $('.home_continue').removeAttr("data-dismiss", "modal");
            $('.home_continue').prop('disabled',true);
            $('.home_continue').css('cursor', 'no-drop');
        }
    });
}(jQuery);
</script>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if (empty($file_name)) {
            echo "<span class='error'>Please Select any Image !</span>";
        }
        elseif ($file_size >1048567) {
            echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } 
        elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } 
        else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_image(image) VALUES('$uploaded_image')";
            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
                echo "<span class='success'>Image Inserted Successfully.</span>";
            }
            else {
                echo "<span class='error'>Image Not Inserted !</span>";
            }
        }
    }
?>


<!-- PDF attachement for contact form 7 -->
1. Upload the attachment to media
2. Place the link in attachment textbox -> ../wp-content/uploads/2018/06/Pdf_name.pdf

<div class="row">
    <div class="col-sm-6 kont-input">
        <div class="profile-input">[text* name class:form-input placeholder "Mia Mustermann"]<span class="highlight"></span>
            <span class="bar"></span>
            <label>Name</label>
        </div>
    </div>
    <div class="col-sm-6 kont-input">
        <div class="profile-input">[email* email-845 class:form-input placeholder "mia@mustermann.com"]<span class="highlight"></span>
            <span class="bar"></span>
            <label>Email</label>
        </div>
    </div>
    <div class="col-sm-6 kont-input">
        <div class="profile-input">[tel* tel-325 class:form-input placeholder "+49 - (0)171 - 9999"]<span class="highlight"></span>
            <span class="bar"></span>
            <label>Telefonnummer</label>
        </div>
    </div>
    <div class="col-sm-6 kont-input">
        <div class="profile-input">[text* company class:form-input placeholder "Mustermann Manufaktur"]<span class="highlight"></span>
            <span class="bar"></span>
            <label>Unternehmen</label>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12">
        <div class="profile-input profile-cust">
[textarea textarea-293 class:form-input placeholder "Bitte hier eintippen..."]          
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Nachricht</label>
            <div class="submit-outer">[submit class:submit-btn-frm]
            </div>
        </div>
    </div>
    <div class="com-sm-12">
        <div class="custom-chk-bx">
            <label class="chk-bx-area">
                [checkbox* checkbox-148 "Sie erklaren sick damit einverstanden. dass Wire Daten zur Bearbeitung Wires Anliegens verwendet werden. Informationen and Widerrufshinwetse linden Sie in der <a href=&quot;#&quot;>Datenschutzerklarung</a>."]
                <!--<span class="checkmark"></span>-->
            </label>
        </div>
    </div>
</div>


<!-- new mail template -->
<!DOCTYPE html>
<html style="font-family: Helvetica, Arial, sans-serif;
  font-size: 14px;
  color: #454545;
  margin: 0;
  padding: 0;
  height: 100%;">
<head>
    <meta charset="UTF-8">
</head>
<!-- <body> -->

<body style="margin:0px; padding: 0px;">
    <table style="margin: 20px auto 40px; padding: 0px 0px; border: 0px; border-spacing: 0px;font-size: 14px; color: #454545; vertical-align: middle; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif;" width="720" cellspacing="0" cellpadding="0" border="0" bgcolor="#6faf44" align="center">
       
        <tr>
            <td style="padding: 20px 10px 0px; text-align:center; vertical-align: middle;" align="center">
                <img src="http://esolz.co.in/lab5/wordpress/AventaSeniorLivingFranchising/wp-content/uploads/2018/01/logo.png" alt="logo" width="134" height="auto">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 30px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                <table style="width:100%; margin: 0px auto; padding: 0px 30px 0px; border-left: 0px; border-right: 0px; border-top: 2px solid #ffbc00; border-bottom: 2px solid #ffbc00; border-spacing: 0px;font-size: 14px; color: #6c6c6c; vertical-align: middle; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif;" cellspacing="0" cellpadding="0" border="0" bgcolor="#f5f5f5" align="center">
                    <tr>
                        <td style="width:100%;padding: 50px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              Dear Admin,<br>You have received email form [text-254].
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%;padding: 30px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              <strong>Name:</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%;padding: 5px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              [text-254]
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%;padding: 30px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              <strong>Email:</strong>
                        </td>
                    </tr>
                 
                    <tr>
                        <td style="width:100%;padding: 5px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                             <a target="_blank" href="mailto:[email-49]" style="text-decoration: none; padding: 0px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;display: inline-block;vertical-align: middle;text-align:left; color:#03bbd2;border: none;">[email-49]</a>.
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%;padding: 30px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              <strong>How did you hear about us?</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%;padding: 5px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              [text-602]
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 50px 0px 50px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                              Take Care, <br>Aventa Senior Living Franchising
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size: 14px;color: #6c6c6c;vertical-align: middle;text-align:left;" align="center">
                <table style="width:100%; margin: 0px auto; padding: 0px 30px 0px; border-spacing: 0px;font-size: 12px; color: #6c6c6c; vertical-align: middle; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif;" cellspacing="0" cellpadding="0" border="0" align="center">
                    <tr>
                        <td style="padding: 0px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size:10px;color: #fff;vertical-align: middle;text-align:center;font-weight: bold;" align="center">Aventa Senior Living Franchising
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 0px 0px; font-family:Century Gothic,Verdana, Geneva, sans-serif,Apple Gothic,AppleGothic,URW Gothic L,Avant Garde,Futura,sans-serif; font-size:10px;color: #fff;vertical-align: middle;text-align:center;" align="center">
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

//comment number
<?php echo get_comments_number(); ?>

//Add theme support for Custom Logo.
<?php 
    add_theme_support( 'custom-logo', array(
        'width'       => 250,
        'height'      => 250,
        'flex-width'  => true,
    ) );
?>

<!-- define constants in php -->
<?php 
    define('THEME_DIR_PATH', get_template_directory());
    define('THEME_DIR_URI', get_template_directory_uri());
?>

//no of posts by an author
<?php 
    $type=array('post','videos');
    printf( __( 'Total Posts : %d', 'wpdocs_textdomain' ), count_user_posts( get_current_user_id() , $type) ); 
?>

<img src="<?php echo get_avatar_url(get_current_user_id()); ?>" alt="">

<script>
$("#slct").selectmenu({
    change: function(event, ui) {
        var cat_id=(ui.item.value);
        var data = { 
            'action': 'etf_post', 
            'category': cat_id
        };
        $.post('<?php echo admin_url( 'admin-ajax.php' );?>', data, function(response) { 
            $('.add_row').html(response);
        }); 
    }
});
</script>

on_submit: "$('.chatFig h3').html('Thank You ! Your Message has sent .');"
