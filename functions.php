<?php 

require get_template_directory() . '/inc/customizer.php';

function plantytheme_load_style(){
    wp_enqueue_style( 'template.css', get_template_directory_uri() . '/css/template.css'); 
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0', true);  
}
add_action( 'wp_enqueue_scripts', 'plantytheme_load_style' );

function plantytheme_config(){
    register_nav_menus(
        array(
            'plantytheme_main_menu' => 'Main Menu',
            'plantytheme_footer_menu' => 'Footer Menu'
        )
    );

    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true
    ) );
// Gutenberg support
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style-editor.css' );
}
add_action( 'after_setup_theme', 'plantytheme_config', 0 );



//sidebar
add_action( 'widgets_init', 'plantytheme_sidebars' );
function plantytheme_sidebars(){
    register_sidebar(
        array(
            'name'  => 'Blog Sidebar',
            'id'    => 'sidebar-blog',
            'description'   => 'This is the Blog Sidebar. You can add your widgets here.',
            'before_widget' => '<div class="widget-wrapper">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );
}

add_filter( 'wp_nav_menu_items', 'prefix_add_menu_item', 10, 2 );
function prefix_add_menu_item ( $items, $args ) {
   if($args->theme_location == 'planty_theme_main_menu') {
       $items_array = array();
               while ( false !== ( $item_pos = strpos ( $items, '<li', 10 ) ) ) // Add the position where the menu item is placed
               {
                   $items_array[] = substr($items, 0, $item_pos);
                   $items = substr($items, $item_pos);
               }
               $items_array[] = $items;
               array_splice($items_array, 1, 0, '<li class="admin_button"><a href="' . get_admin_url() .'">Admin</a></li>'); // insert custom item after 1
       
               $items = implode('', $items_array);
            }  
              
              return $items;
}