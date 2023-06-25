<?php
class TCA_Quote_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'quote-slider';
	}

	public function get_title() {
		return esc_html__( 'Quote Slider', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'tca-widgets' ];
	}

	public function get_keywords() {
		return [ 'slider', 'quote' ];
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

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'author',
			[
				'label' => esc_html__( ' Author', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Author name', 'textdomain' ),
				'show_label' => true,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Description goes to here', 'textdomain' ),
				'show_label' => true,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'show_label' => true,
				'label_block' => true,
			]
		);
		$this->add_control(
			'quotes',
			[
				'label' => esc_html__( 'Quotes', 'news-ticker-for-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ author }}}',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'General Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'height',
			[
				'label' => esc_html__( 'Slider Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'show_label' => true,
				'label_block' => true,
                'min' => 100,
				'max' => 500,
				'step' => 5,
				'default' => 400,
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Description Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .review-content h2',
			]
		);

        $this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review-content h2' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'description_spacing',
			[
				'label' => esc_html__( 'Description Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .review-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'author_style',
			[
				'label' => esc_html__( 'Author Style', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'selector' => '{{WRAPPER}} .review-author',
			]
		);

        $this->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Author Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review-author' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'author_spacing',
			[
				'label' => esc_html__( 'Author Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .review-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		?>
            <div class="review-slider-section ">
                
            <?php if( !empty( $settings['quotes'] ) ) { ?>
                <div class="swiper quote-slider">
                    <div class="swiper-wrapper">

                    <?php foreach( $settings['quotes'] as $quote ) { ?>
                        <div class="review-slide swiper-slide">
                            <div class="swiper-slider-bg" style="height: <?php echo $settings['height']; ?>px; background-image: url('<?php echo $quote['image']['url'] ?>')">
                                <div class="review-content"><h2><?php echo $quote['description']; ?></h2></div>
                                <div class="review-author">~ <?php echo $quote['author']; ?></div>
                            </div>
                        </div>
                    <?php } ?>

                    </div>

                </div><!--end .header_slider_area-->
            <?php } ?>

            </div>
		<?php
	}
}
