<?php if ( ! defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}

function the_core_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'the_core_theme_enqueue_styles' );


/**
 * @param array $atts
 */
function the_core_top_bar( $atts = array('top_bar_text' => '', 'enable_header_socials' => '', 'enable_search' => '', 'search_type' => '', 'placeholder_text' => '', 'search_position' => '') )
{
    if ( $atts['enable_header_socials'] == 'yes' ) {
        echo the_core_get_socials( 'fw-top-bar-social' );
    }
}


/**
 * Display post meta (date, category, author)
 *
 * @param string $post_id
 * @param string $post_type
 * @param array $atts
 */
function the_core_post_meta( $post_id, $post_type = 'post', $atts = array( 'extra_options' => array() ), $elements_to_hide = array() ) {
    $the_core_permalink = get_permalink($post_id);
    $posts_general_settings = defined( 'FW' ) ? fw_get_db_settings_option( 'posts_settings', '' ) : array();
    if( !empty( $atts['extra_options'] ) ) {
        // change general settings with extra options (from shortcode, or an other resource - only the values from extra_options)
        $posts_general_settings = array_merge( $posts_general_settings, $atts['extra_options'] );
    }
    $post_date       = isset( $posts_general_settings['post_date'] ) ? $posts_general_settings['post_date'] : '';
    $post_author     = isset( $posts_general_settings['post_author'] ) ? $posts_general_settings['post_author'] : '';
    $post_categories = isset( $posts_general_settings['post_categories'] ) ? $posts_general_settings['post_categories'] : '';

    if(!empty($elements_to_hide))
    {
        if(in_array('category',$elements_to_hide)) $post_categories = 'no';
        if(in_array('author',$elements_to_hide)) $post_author = 'no';
    }

    if($post_date != 'no' || $post_author != 'no' || $post_categories != 'no') : ?>
        <div class="wrap-entry-meta">
            <?php if ( $post_date != 'no' ) : ?>
                <span class="entry-date">
                    <time class="time-published" itemprop="datePublished" datetime="<?php the_core_get_datetime_attribute(); ?>"><?php echo get_the_date(); ?></time>
                </span>
                <span>
                    <?php the_core_get_blog_comments_number( array( 'permalink' => $the_core_permalink, 'extra_options' => [] ) ); ?>
                </span>
            <?php endif; ?>
            <?php if ( $post_author != 'no' ) : ?>
                <?php if ( $post_date != 'no' ) : ?>
                    <span class="separator">&nbsp;|&nbsp;</span>
                <?php endif; ?>
                <span itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author" class="author"> <?php esc_html_e( 'By', 'the-core' ); ?> <?php the_author_posts_link(); ?></span>
            <?php endif; ?>
            <?php if ( ( $post_categories != 'no' && $post_type != 'fw-learning-articles' ) && $post_type != 'lesson' ) : ?>
                <?php if ( ($post_author != 'no' || $post_date != 'no') && !is_single() ) : ?>
                    <span class="separator">&nbsp;|&nbsp;</span>
                <?php endif; ?>
                <span class="cat-links"> <?php esc_html_e( 'In', 'the-core' ); ?> <?php echo the_core_cat_links( $post_type, $post_id ); ?></span>
            <?php endif; ?>
        </div>
    <?php endif;
}

/**
 * return post comments number
 *
 * @param array $atts
 */
function the_core_get_blog_comments_number( $atts = array('permalink' => '#', 'extra_options' => array() ) ) {
    $comments_number['selected'] = 'yes';
    $comments_number['yes']['comments_number_type'] = 'fw-comment-link-type-1';
    if( function_exists('fw_get_db_settings_option') ) {
        $comments_number = fw_get_db_settings_option( 'posts_settings/display_comments_number' );
        // for extra options (shortcodes or other source)
        if( isset( $atts['extra_options']['display_comments_number'] ) ) {
            $comments_number = array_merge( $comments_number, $atts['extra_options']['display_comments_number'] );
        }
    }

    if($comments_number['selected'] == 'yes') : ?>
        <?php if( $comments_number['yes']['comments_number_type'] == 'fw-comment-link-type-6') : ?>
            <a href="<?php echo esc_attr($atts['permalink']); ?>#comments" class="comments-link fw-comment-link-type-6">
                <i class="fa fa-comment-o" aria-hidden="true"></i>
                <span class="text-comments"><?php comments_number( esc_html__( 'Comments', 'the-core' ), esc_html__( 'Comment', 'the-core' ), esc_html__( 'Comments', 'the-core' ) ); ?></span>
<!--                <span class="divide-comments">--><?php //echo apply_filters( 'fw_comment_link_type_6_separator', '/'); ?><!--</span>-->
                <span><?php comments_number( esc_html__( '0', 'the-core' ), esc_html__( '1', 'the-core' ), esc_html__( '%', 'the-core' ) ); ?></span>
            </a>
        <?php else : ?>
            <a href="<?php echo esc_attr($atts['permalink']); ?>#comments" class="comments-link <?php echo esc_attr($comments_number['yes']['comments_number_type']); ?>">
                <i class="fa fa-comment-o" aria-hidden="true"></i>
                <span><?php comments_number( esc_html__( '0', 'the-core' ), esc_html__( '1 comment', 'the-core' ), esc_html__( '% comments', 'the-core' ) ); ?></span></a>
        <?php endif; ?>
    <?php endif;
}

function the_core_footer2() {
    $the_core_footer_settings     = defined( 'FW' ) ? fw_get_db_settings_option( 'footer_settings' ) : array();
    $themefuse_link      = 'http://themefuse.com/';
    $show_footer_widgets = isset( $the_core_footer_settings['show_footer_widgets']['selected_value'] ) ? $the_core_footer_settings['show_footer_widgets']['selected_value'] : 'yes';
    $show_menu_bar       = isset( $the_core_footer_settings['show_menu_bar']['selected_value'] ) ? $the_core_footer_settings['show_menu_bar']['selected_value'] : 'yes';
    $copyright_position  = isset( $the_core_footer_settings['copyright_position'] ) ? $the_core_footer_settings['copyright_position'] : 'fw-copyright-center';
    $footer_socials      = isset( $the_core_footer_settings['footer_socials']['selected_value'] ) ? $the_core_footer_settings['footer_socials']['selected_value'] : 'no';
    $copyright           = isset( $the_core_footer_settings['copyright'] ) ? $the_core_footer_settings['copyright'] : 'Copyright &copy;2015 <a href="'.$themefuse_link.'" rel="nofollow">ThemeFuse</a>. All Rights Reserved';
    $bg_image            = isset( $the_core_footer_settings['footer_bg_image'] ) ? $the_core_footer_settings['footer_bg_image'] : '';
    ?>
    <?php if ( $show_footer_widgets == 'yes' ) :
        get_template_part( 'templates/footers/footer-widgets' );
    endif; ?>

    <?php if ( $show_menu_bar == 'yes' ) :
        get_template_part( 'templates/footers/footer-menu' );
    endif; ?>

    <div class="fw-footer-bar <?php echo esc_attr($copyright_position); ?>"
    <?php if($bg_image['url'] != '' ) echo 'style=" background-color: rgba(0, 0, 0, .5);"'; ?>
    >
        <div class="fw-footer-bar2" <?php if($bg_image['url'] != '' ) echo 'style="background-image: url('.$bg_image['url'].');"'; ?>>
            <div class="fw-container">
                <?php if ( $footer_socials == 'yes' ) {
                    echo the_core_get_socials( 'fw-footer-social' );
                } ?>
                <div class="fw-copyright"><?php echo $copyright; ?></div>
            </div>
        </div>
    </div>
<?php }