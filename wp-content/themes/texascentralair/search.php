<?php
    get_header();
    echo '<h2>Displaying Search Result for <strong>' . $_GET['s'] . '</strong></h2>';
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
    }
get_footer();
?>