<?php get_header(); ?>
    <div class="search-result-page-container">
    <h2>Displaying Search Result for <strong><?php echo ucfirst($_GET['s']); ?></strong></h2>
    <?php
        if( have_posts() ){
            while( have_posts() ){
                the_post();
?>
                <div class="tca-blog-grid">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="tca-blog-grid-excerpt"><h3><?php the_excerpt(); ?></h3></div>
                    <div class="tca-blog-grid-button"><a class="elementor-button" href="<?php the_permalink(); ?>">Read More</a></div>
                </div>
<?php
            }
            the_posts_pagination( array(
                'prev_text' => __( 'Previous', 'twentyfifteen' ),
                'next_text' => __( 'Next', 'twentyfifteen' ),
                'type'      => 'list',
                'class'     => 'tca-blog-pagination',
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
            ) );
        }else{
?>
            <h3>No Result for <strong><?php echo ucfirst($_GET['s']); ?></strong></h3>
    <?php } ?>
    </div>
<?php get_footer(); ?>