<?php 
/*/
Plugin Name: Spacific Sidebar
Plugin URI: www.sumitsharma1988.co.cc
Description: this is use for show spacific sidebar on spacific pages.
Version: 101
Author: Sumit Sharma
Author URI: www.sumitsharma1988.co.cc
/*/
/////sidebar by sumit...

add_filter( 'body_class', 'twentyeleven_body_classes' );


        add_action("admin_init", "sidebar_init");
        add_action('save_post', 'save_sidebar_link');
        function sidebar_init(){
                add_meta_box("sidebar_meta", "Sidebar Selection", "sidebar_link", "page", "side", "default");
        }
        function sidebar_link(){
                global $post, $dynamic_widget_areas;
                $custom  = get_post_custom($post->ID);
                $link    = $custom["_sidebar"][0];
        ?>
<div class="link_header">
        <?php
		
echo '<select name="link" class="sidebar-selection">';
 foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) 
 {
  
 $n = $sidebar['name'];
 $s = ucwords( $sidebar['id'] );
	$dynamic_widget_areas1 = array(
	"$s" => "$n");

	if($link == $s){
	
	echo '<option value="';
	echo ucwords( $sidebar['id'] );
	if($s == ucwords( $sidebar['id'] ))
	{
	echo '" selected="true">';
	}else{
	echo ' ">';
	}
    
	echo $n;
     echo '</option>';
                     
                        }else{
						echo '<option value="'.ucwords( $sidebar['id'] ).'">';
    
             echo ucwords( $sidebar['name'] );  
			
                     
                  } 
 
	
 } 
echo '</select><br />';


        ?>
</div>
<p>Select sidebar to use on this page.</p>
<?php
}
function save_sidebar_link(){
global $post;
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {return $post->ID;}
        update_post_meta($post->ID, "_sidebar", $_POST["link"]);
}
add_action('admin_head', 'sidebar_css');
function sidebar_css() {
        echo'
        <style type="text/css">
                .sidebar-selection{width:100%;}
        </style>
        ';
}
