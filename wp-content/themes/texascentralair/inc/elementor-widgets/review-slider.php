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
		?>
            <!--<div class="tcb-banner"><center><img class="aligncenter" src="/wp-content/uploads/2021/11/Yeti-Bundle-Website.png" alt="" style="max-width:100%;" /></center></div>-->
            <div class="swiper deal-slider">
				<section class="header_slider_area swiper-wrapper" id="indexcarousel" style="">
				<!-- <section>     -->
				<?php if ( $settings['deal_lists'] ) { $count=0; foreach (  $settings['deal_lists'] as $item ) { $count++; ?>
					<div class="swiper-slide "> 
						<div id="slidersize<?php echo $count === 2 ? '4' : '3'; ?>" class="header_slider_bg" style="padding: 80px 0 100px 0; background-image: url(<?php echo $item['list_image']['url']; ?>);">
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<p><?php echo $item['list_subtitle'];?></p>
										<h2 style="font-size: 50px;"><?php echo $item['list_title'];?></h2>
										<p style="margin-top: 20px"><?php echo $item['list_short_description'];?></p> 
										<div class="slide_button">
											<a href="<?php echo $item['button_link']['url'];?>" class="btn-yellow" style="cursor: pointer;margin-top: 10px;"><?php echo $item['button_text'];?></a>
										</div><!--end .slide_button-->
										<p style="margin: 0px; padding: 0px; font-size: 12px"><?php echo $item['list_description'];?></p>
									</div><!--end .col-md-6-->
								</div><!--end .row-->
							</div><!--end .container-->
						</div></div><!--end .header_slider_bg-->
					<?php } } ?>
				

				</section>
				<div class="swiper-pagination"></div>
			</div><!--end .header_slider_area-->
		<?php
	}
}
