<?php
if ( ! function_exists( 'themename_setup' ) ) :

    function chelseakmakeup_setup() {

        load_theme_textdomain( 'themename', get_template_directory() . '/languages' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-formats', array('gallery') );

        add_theme_support( 'post-thumbnails' );

        add_image_size('gallery', 320, 320, array('center', 'center'));

        add_image_size('carousel', 800, 450, array('center', 'center'));

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'chelseakmakeup' ),
            'social' => esc_html__( 'Social Menu', 'chelseakmakeup' ),
        ));

    }

endif;
add_action( 'after_setup_theme', 'chelseakmakeup_setup' );

function chelseakmakeup_scripts() {

    wp_enqueue_style( 'bootstrap-min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );

    wp_enqueue_style('main-style', get_stylesheet_uri() );

    wp_enqueue_script('prefix-free', get_template_directory_uri() . '/js/prefixfree.min.js');

    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.0.min.js');

    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');

    wp_enqueue_script('masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/4.0.0/masonry.pkgd.min.js');

    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');

}

add_action('wp_enqueue_scripts', 'chelseakmakeup_scripts');

function chelseak_primary_menu() {
    wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_id' => 'primary-menu',
        'menu_class' => 'menu nav navbar-nav'
    ) );
}

//Add SVG support
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//Customize WordPress gallery for posts.
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);

    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    $output = "<div class=\"carousel slide carousel-fade\" data-ride=\"carousel\" id=\"carousel-" . $post->ID . "\">\n";
    $output .= "<ol class='carousel-indicators'>";

    $number_of_pictures = count($attachments);

    if($number_of_pictures > 1) {

        for ($i = 0; $i <= ($number_of_pictures - 1); $i++) {
            $active = '';
            if ($i == 0) {
                $active = " class='active'";
            }
            $output .= "<li data-target='#carousel-" . $post->ID . "' data-slide-to='" . $i . "'" . $active . "></li>";
        }
    }

    $output .= "</ol>";
    $output .= "<div class=\"carousel-inner\">\n";

    $first = true;
    foreach ($attachments as $id => $attachment) {
        $img = wp_get_attachment_image_src($id, 'carousel');

        if($first) {
            $output .= "<div class=\"item modal-photos active\">\n";
            $first = false;
        } else {
            $output .= "<div class=\"item modal-photos\">\n";
        }
        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
        $output .= "</div>\n";
    }

    if( $number_of_pictures > 1 ) {
    $output .= "</div>\n";
    $output .= "<a class='left carousel-control' href='#carousel-" . $post->ID . "' role='button' data-slide='prev'>";
    $output .= "<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>";
    $output .= "<span class='sr-only'>Previous</span>";
    $output .= "</a>";
    $output .= "<a class='right carousel-control' href='#carousel-" . $post->ID . "' role='button' data-slide='next'>";
    $output .= "<i class='glyphicon glyphicon-chevron-right' aria-hidden='true'></i>";
    $output .= "<span class='sr-only'>Next</span>";
    $output .= "</a>";
    }

    $output .= "</div>\n";

    return $output;
}