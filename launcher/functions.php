<?php

function launcher_bootstraping(){
    load_theme_textdomain('launcher');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}

add_action( 'after_setup_theme', 'launcher_bootstraping' );




function launcher_scripts(){

    if(is_page()){
        $page_template_name = basename(get_page_template());

        if($page_template_name == 'launcher.php'){
            wp_enqueue_style( 'launcher-stylesheet', get_stylesheet_uri() );
            wp_enqueue_style( 'animate-css', get_template_directory_uri(  ).'/assets/css/animate.css' );
            wp_enqueue_style( 'bootstrap-css', get_template_directory_uri(  ).'/assets/css/bootstrap.css' );
            wp_enqueue_style( 'icomoon-css', get_template_directory_uri(  ).'/assets/css/icomoon.css' );
            wp_enqueue_style( 'style-css', get_template_directory_uri(  ).'/assets/css/style.css' );
        
            wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-easing', get_template_directory_uri().'/assets/js/jquery.easing.1.3.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-waypoint', get_template_directory_uri().'/assets/js/jquery.waypoints.min.js', array('jquery'),null, true);
            wp_enqueue_script('simply-countdown', get_template_directory_uri().'/assets/js/simplyCountdown.js', array('jquery'), null, true);
            wp_enqueue_script('launcher-script', get_template_directory_uri().'/assets/js/main.js', array('jquery'), null, true);
        
            $launch_year = get_post_meta( get_the_ID(), 'year', true );
            $launch_month = get_post_meta( get_the_ID(), 'month', true );
            $launch_day = get_post_meta( get_the_ID(), 'day', true );
        
            wp_localize_script( 'launcher-script', 'datedata', array(
                'year' => $launch_year,
                'month' => $launch_month,
                'day' => $launch_day,
            ) );        
        }
    }

}

add_action( 'wp_enqueue_scripts', 'launcher_scripts' );

function launcher_background_banner(){
    if(is_page()){
        $comming_soon_thumbnail_url = get_the_post_thumbnail_url( null, 'large' );
        ?>
            <style>
                #fh5co-aside{
                    background: url('<?php echo $comming_soon_thumbnail_url ?>');
                }
            </style>
        <?php
    }
}
add_action( 'wp_head', 'launcher_background_banner', 11 );

function launcher_widgets(){
    register_sidebar( array(
        'name'          => __( 'Footer Left Sidebar', 'launcher' ),
        'id'            => 'footer-left',
        'description'   => __( 'Widgets in this area will be shown on footer Left.', 'launcher' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Right Sidebar', 'launcher' ),
        'id'            => 'footer-right',
        'description'   => __( 'Widgets in this area will be shown on footer Right.', 'launcher' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

add_action( 'widgets_init', 'launcher_widgets' );



?>