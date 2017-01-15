<?php
/**
 * The template for displaying posts in the Gallery post format
 */

global $post;
if( !isset( $extra_options ) ) $extra_options = array();
$the_core_permalink    = get_permalink();
$the_core_blog_title   = the_core_get_blog_title( array( 'extra_options' => $extra_options ) );
$image_alignment       = !empty($the_core_post_options['image_alignment']) ? $image_alignment = $the_core_post_options['image_alignment'].'-align' : '';
$post_author           = the_core_post_type_3_author( array('extra_options' => $extra_options) );
$comments_number       = the_core_post_type_3_comments_number( array('extra_options' => $extra_options) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( "post clearfix post-list-type-3" ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
    <header class="entry-header">
        <?php the_core_post_type_3_date($the_core_permalink, array('extra_options' => $extra_options) ); ?>

        <<?php echo $the_core_blog_title; ?> class="entry-title" itemprop="headline">
        <a href="<?php echo esc_url($the_core_permalink); ?>"><?php the_title(); ?></a>
    </<?php echo $the_core_blog_title; ?>>
    </header>

    <div class="entry-content clearfix" itemprop="text">
        <?php the_core_post_type_3_categories($post->ID, array('extra_options' => $extra_options)); ?>
        <div class="post-content">
            <?php the_content(); ?>
        </div>

        <footer class="entry-meta clearfix <?php echo ($post_author == 'no') ?  'post-author-no' : ''; ?> <?php echo (isset($comments_number['selected']) && $comments_number['selected'] == 'no') ?  'comments-link-no' : ''; ?>">
            <?php if ( $post_author != 'no' ) : ?>
                <span itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author" class="author"> <?php the_author_posts_link(); ?></span>
            <?php endif; ?>
            <div class="wrap-blog-button">
                <?php the_core_get_blog_button( array( 'permalink' => $the_core_permalink, 'extra_options' => $extra_options ) ); ?>
            </div>
            <div class="wrap-comments-link">
                <?php the_core_get_blog_comments_number( array( 'permalink' => $the_core_permalink, 'extra_options' => $extra_options ) ); ?>
            </div>
        </footer>
    </div>
</article>