<?php
// ============================================================================
// Theme Setup ================================================================
function TD__setup() {
    load_theme_textdomain( 'TD_', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
    add_theme_support( 'appearance-tools' );
    add_theme_support( 'woocommerce' );
    global $content_width;
    if ( !isset( $content_width ) ) { 
        $content_width = 1920; 
    }
    register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'TD_' ) ) );
}
// adding the action
add_action( 'after_setup_theme', 'TD__setup' );
// ============================================================================
// Admin Notice ===============================================================
function TD__notice() {
    $user_id = get_current_user_id();
    $admin_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $param = ( count( $_GET ) ) ? '&' : '?';
    if ( !get_user_meta( $user_id, 'TD__notice_dismissed_11' ) && current_user_can( 'manage_options' ) ){
        echo '<div class="notice notice-info"><p><a href="' . esc_url( $admin_url ), esc_html( $param ) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__( 'Ⓧ', 'TD_' ) . '</big></a>' . wp_kses_post( __( '<big><strong>🏆 Thank you for using TD_!</strong></big>', 'TD_' ) ) . '<p>' . esc_html__( 'Powering over 10k websites! Buy me a sandwich! 🥪', 'TD_' ) . '</p><a href="https://github.com/bhadaway/TD_/issues/57" class="button-primary" target="_blank"><strong>' . esc_html__( 'How do you use TD_?', 'TD_' ) . '</strong></a> <a href="https://opencollective.com/TD_" class="button-primary" style="background-color:green;border-color:green" target="_blank"><strong>' . esc_html__( 'Donate', 'TD_' ) . '</strong></a> <a href="https://wordpress.org/support/theme/TD_/reviews/#new-post" class="button-primary" style="background-color:purple;border-color:purple" target="_blank"><strong>' . esc_html__( 'Review', 'TD_' ) . '</strong></a> <a href="https://github.com/bhadaway/TD_/issues" class="button-primary" style="background-color:orange;border-color:orange" target="_blank"><strong>' . esc_html__( 'Support', 'TD_' ) . '</strong></a></p></div>';
    }
  
}
// adding the action
add_action( 'admin_notices', 'TD__notice' );
// ============================================================================
// Admin Notice Dismissed =====================================================
function TD__notice_dismissed() {
    $user_id = get_current_user_id();
    if ( isset( $_GET['dismiss'] ) ){
        add_user_meta( $user_id, 'TD__notice_dismissed_11', 'true', true );
    }
}
// adding the action
add_action( 'admin_init', 'TD__notice_dismissed' );
// ============================================================================
// Enquing Scripts/Styles =====================================================
function TD__enqueue() {
    wp_enqueue_style( 'TD_-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
}
// adding the action
add_action( 'wp_enqueue_scripts', 'TD__enqueue' );
// ============================================================================
// Footer =====================================================================
function TD__footer() {
?>
<script>
    jQuery(document).ready(function($) {
        var deviceAgent = navigator.userAgent.toLowerCase();
        if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
            $("html").addClass("ios");
            $("html").addClass("mobile");
        }

        if (deviceAgent.match(/(Android)/)) {
            $("html").addClass("android");
            $("html").addClass("mobile");
        }

        if (navigator.userAgent.search("MSIE") >= 0) {
            $("html").addClass("ie");
        } else if (navigator.userAgent.search("Chrome") >= 0) {
            $("html").addClass("chrome");
        } else if (navigator.userAgent.search("Firefox") >= 0) {
            $("html").addClass("firefox");
        } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
            $("html").addClass("safari");
        } else if (navigator.userAgent.search("Opera") >= 0) {
            $("html").addClass("opera");
        }
    });
</script>
<?php
}
// adding the action
add_action( 'wp_footer', 'TD__footer' );
// ============================================================================
// Document Title Seperator ===================================================
function TD__document_title_separator( $sep ) {
    $sep = esc_html( '|' );
    return $sep;
}
// adding the filter
add_filter( 'document_title_separator', 'TD__document_title_separator' );
// ============================================================================
// Document Title =============================================================
function TD__title( $title ) {
    if ( $title == '' ) {
        return esc_html( '...' );
    } else {
        return wp_kses_post( $title );
    }
}
// adding the filter
add_filter( 'the_title', 'TD__title' );
// ============================================================================
// Setting the Schema type ====================================================
function TD__schema_type() {
    $schema = 'https://schema.org/';
    if ( is_single() ) {
        $type = "Article";
    } elseif ( is_author() ) {
        $type = 'ProfilePage';
    } elseif ( is_search() ) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }
    echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
// ============================================================================
// Setting the Schema url =====================================================
function TD__schema_url( $atts ) {
    $atts['itemprop'] = 'url';
    return $atts;
}
// adding the filter
add_filter( 'nav_menu_link_attributes', 'TD__schema_url', 10 );

if ( !function_exists( 'TD__wp_body_open' ) ) {
    function TD__wp_body_open() {
        do_action( 'wp_body_open' );
    }
}
// ============================================================================
// Setting the Schema url =====================================================
add_action( 'wp_body_open', 'TD__skip_link', 5 );
function TD__skip_link() {
    echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'TD_' ) . '</a>';
}
// ============================================================================
// Setting the Content More Link ==============================================
add_filter( 'the_content_more_link', 'TD__read_more_link' );
function TD__read_more_link() {
    if ( !is_admin() ) {
        return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'TD_' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
    }
}
// ============================================================================
// Excerpt More ===============================================================
add_filter( 'excerpt_more', 'TD__excerpt_read_more_link' );
function TD__excerpt_read_more_link( $more ) {
    if ( !is_admin() ) {
        global $post;
        return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'TD_' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
    }
}

add_filter( 'big_image_size_threshold', '__return_false' );
// ============================================================================
// Intermediate Image Sizes ===================================================
add_filter( 'intermediate_image_sizes_advanced', 'TD__image_insert_override' );
function TD__image_insert_override( $sizes ) {
    unset( $sizes['medium_large'] );
    unset( $sizes['1536x1536'] );
    unset( $sizes['2048x2048'] );
    return $sizes;
}
// ============================================================================
// Widgets ====================================================================
add_action( 'widgets_init', 'TD__widgets_init' );
function TD__widgets_init() {
    register_sidebar( array(
    'name' => esc_html__( 'Sidebar Widget Area', 'TD_' ),
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
}
// ============================================================================
// Ping Back ==================================================================
add_action( 'wp_head', 'TD__pingback_header' );
function TD__pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
// ============================================================================
// Comment From Before ========================================================
add_action( 'comment_form_before', 'TD__enqueue_comment_reply_script' );
function TD__enqueue_comment_reply_script() {
    if ( get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
// ============================================================================
// Custom Pings ===============================================================
function TD__custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
// ============================================================================
// Get Comments Number ========================================================
add_filter( 'get_comments_number', 'TD__comment_count', 0 );
function TD__comment_count( $count ) {
    if ( !is_admin() ) {
        global $id;
        $get_comments = get_comments( 'status=approve&post_id=' . $id );
        $comments_by_type = separate_comments( $get_comments );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}