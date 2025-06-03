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
            <div class="scroll__openWrapper z-90">
                <div class="scroll__openButton bg-cream border-solid border-1 border-night">
                    Click to Open
                </div>
            </div>
            <div class="aspect-14/3 h-40 relative z-30 invitation__scrollTop">
                <img src="/wp-content/uploads/2025/06/scroll_top_resize.png" alt="" class="scrollBg">
            </div>
            <div class="h-150 bg-cream w-140 z-10 invitation__scrollInner rolled">
                <div class="invitation__scrollContent relative">
                    <a title="Close Scroll" href="javascript:;" class="invitation__close">X</a>
                    <h1 class="text-night text-center" >Be my Bridesmade???????</h1>
                    <?php 
                        echo do_shortcode( '[contact-form-7 id="06e3a6d" title="Bridesmaids Proposal"]' , true );
                    ?>
                </div>
                
            </div>
            <div class="aspect-14/3 h-40 z-30 relative invitation__scrollBottom">
                <img src="/wp-content/uploads/2025/06/scroll_bottom_resize.png" alt="" class="scrollBg">
            </div>
        </div>
    </div>
<?php get_footer(); ?>