<?php
class TCA_Blog_Posts extends \Elementor\Widget_Base {

	public function get_name() {
		return 'blog-posts';
	}

	public function get_title() {
		return esc_html__( 'Blog Posts', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'tca-widgets' ];
	}

	public function get_keywords() {
		return [ 'blog' ];
	}

    protected function register_controls() {

        /**
         * Section Main Title Start
         */
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'limit',
			[
				'label' => esc_html__( 'Post Limit', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'show_label' => true,
				'label_block' => true,
                'min' => 1,
				'max' => 50,
				'step' => 1,
				'default' => 10,
			]
		);

        $this->add_control(
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $args = array(
            'posts_per_page' => $settings['limit'],
        );
        if ( 'yes' === $settings['pagination'] ) {
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $args['paged'] = $paged;
        }
        $posts= new WP_Query( $args );

        if( $posts->have_posts() ){
            while( $posts->have_posts() ){
                $posts->the_post();
		?>
            <div class="tca-blog-grid">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="tca-blog-grid-excerpt"><h3><?php echo get_the_excerpt(); ?></h3></div>
                <div class="tca-blog-grid-button"><a class="elementor-button" href="<?php the_permalink(); ?>">Read More</a></div>
            </div>
		<?php
            }
            wp_reset_postdata();

            if ( 'yes' === $settings['pagination'] ) {
                echo '<div class="tca-blog-pagination">';

                    $big = 999999999; // need an unlikely integer
                        
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $posts->max_num_pages,
                        'type'=>'list',
                    ) );
                
                echo '</div>';
            }
        }
	}
}
