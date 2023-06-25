<?php
class TCA_Review_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'review-slider';
	}

	public function get_title() {
		return esc_html__( 'Review Slider', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-review';
	}

	public function get_categories() {
		return [ 'tca-widgets' ];
	}

	public function get_keywords() {
		return [ 'slider', 'review' ];
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

        $options = array();

        $reviews = get_posts( array(
            'post_type'  => 'review',
            'posts_per_page' => -1,
        ) );

        foreach ( $reviews as $key => $review ) {
            $options[$review->ID] = get_the_title($review->ID);
        }

        $this->add_control(
			'reviews',
			[
				'label' => esc_html__( 'Reviews', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $options,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'arrows',
			[
				'label' => esc_html__( 'Arrows', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label' => esc_html__( 'Dots', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'button_url',
			[
				'label' => esc_html__( 'Button URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'URL', 'textdomain' ),
				'show_label' => true,
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Button Text', 'textdomain' ),
				'show_label' => true,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		$autoplay = 'yes' === $settings['autoplay'] ? 5000 : 0;
		?>
            <div class="review-slider-section <?php echo esc_attr( $arrows . $dots ); ?>" data-swiper-autoplay="<?php echo esc_attr($autoplay); ?>">
                
            <?php if( !empty( $settings['reviews'] ) ) { ?>
                <div class="swiper review-slider">
                    <div class="swiper-wrapper">

                    <?php foreach( $settings['reviews'] as $review ) { ?>
                        <div class="review-slide swiper-slide">
                            <div class="review-content"><?php echo wp_trim_words( get_the_excerpt( $review ), 47, '...'); ?></div>
                            <div class="review-author">~ <?php echo get_the_title( $review ); ?></div>
                        </div>
                    <?php } ?>

                    </div>

					<?php if ( 'yes' === $settings['dots'] ) { ?>
                    	<!-- If we need pagination -->
                    	<div class="swiper-pagination"></div>
					<?php } ?>
					
					<?php if ( 'yes' === $settings['arrows'] ) { ?>
						<!-- If we need navigation buttons -->
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					<?php } ?>

                </div><!--end .header_slider_area-->
            <?php } ?>

                <div class="review-slider-section-button">
                    <a href="<?php echo $settings['button_url']['url']; ?>"><?php echo $settings['button_text']; ?></a>
                </div>
            </div>
		<?php
	}
}
