<?php
/* Template Name: Bridesmades Proposal */

// ===== Setup =====
// Hiding the menu
$TD__hideMenu = true;
// Hiding the home link
$TD__hideHomeLink = true;
// Hiding the copyright
$TD__hideCopyright = true;

function TD__bridesmaidsStyle(){
    wp_enqueue_style( 'TD__bridesMaidsStyle', get_stylesheet_directory_uri() . '/css/bridesmaids.css' );
    wp_enqueue_script( 'TD__bridesMaidsScript', get_stylesheet_directory_uri() . '/js/bridesmaids.js'  );
}
// adding the action
add_action( 'wp_enqueue_scripts', 'TD__bridesmaidsStyle' );

?>
<?php get_header(); ?>
    <div class="bg-night h-dvh flex flex-col justify-center items-center">
        <div class="invitation__wrapper flex flex-col justify-center items-center">
            <div class="h-30 bg-cream w-200"></div>
            <div class="h-150 bg-cream w-170 rolled">
                <h1 class="text-night text-center" >Be my Bridesmade???????</h1>
                <?php 
                    echo do_shortcode( '[contact-form-7 id="06e3a6d" title="Bridesmaids Proposal"]' , true );
                ?>
            </div>
            <div class="h-30 bg-cream w-200"></div>
        </div>
    </div>
<?php get_footer(); ?>