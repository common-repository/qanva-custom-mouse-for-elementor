<?php
namespace MAKECUSTOMMOUSE\Widgets;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Element_Base;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

use Elementor\Widget_Base;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; 

class MAKECUSTOMMOUSEFORTHEELEMENTOR extends Widget_Base{
	public function get_name(){
		return 'cme_custommouse';
	}

	public function get_title(){
		return 'Custom Mouse';
	}

	public function get_icon(){
		return 'eicon-dot-circle-o';
	}

	public function get_categories(){
		return [ 'basic' ];
	}	
	
		
	protected function register_controls(){
		$this->start_controls_section(
			 'section_content',
			 [
				 'label' => 'Custom Mouse',
			 ]
		 );
		       
		$this->add_control(
			'qanva_cme_use',
			[
				'label' => __( 'Enable custom mouse?', 'qanva-custom-mouse-for-elementor' ), 
				'description' => __( 'A custom mouse for your website.', 'qanva-custom-mouse-for-elementor' ), 
				'separator' => 'after', 
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'qanva-custom-mouse-for-elementor' ),
				'label_off' => __( 'No', 'qanva-custom-mouse-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
				'frontend_available' => true,
			]
		);
				
		$this->add_control(
			'qanva_cme_color',
			[
				'label' => __( 'Pointer Color', 'qanva-custom-mouse-for-elementor' ),
				'type' => Controls_Manager::COLOR,
    'scheme' => [
							'type' => \Elementor\Core\Schemes\Color::get_type(),
							'value' => \Elementor\Core\Schemes\Color::COLOR_1,
						],
				'selectors' => [
					'body #QanvaPointer:not(.is-hover)' => 'background:{{qanva_cme_color.VALUE}} !important;',
					'.prevpointer' => 'background:{{qanva_cme_color.VALUE}}',
				],
     'condition' => [
						'qanva_cme_use' => 'yes', 
					],
			]
		);	
				
		$this->add_control(
			'qanva_cme_color_hover',
			[
				'label' => __( 'Pointer Color hover', 'qanva-custom-mouse-for-elementor' ),
				'type' => Controls_Manager::COLOR,
      'scheme' => [
							'type' => \Elementor\Core\Schemes\Color::get_type(),
							'value' => \Elementor\Core\Schemes\Color::COLOR_1,
						],
				'selectors' => [
					'body #QanvaPointer.is-hover' => 'background:{{qanva_cme_color_hover.VALUE}} !important;',
				],
     'condition' => [
						'qanva_cme_use' => 'yes', 
					],
			]
		);		
				
		$this->add_control(
			'qanva_cme_framecolor',
			[
				'label' => __( 'Outer Color', 'qanva-custom-mouse-for-elementor' ),
				'type' => Controls_Manager::COLOR,
      'scheme' => [
							'type' => \Elementor\Core\Schemes\Color::get_type(),
							'value' => \Elementor\Core\Schemes\Color::COLOR_1,
						],
				'selectors' => [
					'body #QanvaMouseCursor' => 'border:1px solid {{qanva_cme_framecolor.VALUE}} !important;',
				],
     'condition' => [
						'qanva_cme_use' => 'yes', 
					],
			]
		);	
				
		$this->add_control(
			'qanva_cme_pointersize',
			[
				'label' => __( 'Pointer size', 'qanva-custom-mouse-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
       'min' => 0,
							'max' => 50,
							'step' => 1,
					],
                ],
     'default' => [
						'unit' => 'px',
						'size' => 5,
					],
				'size_units' => [ 'px' ],
				'selectors' => [
					'body #QanvaPointer:not(.is-hover)' => 'height:{{qanva_cme_pointersize.SIZE}}{{qanva_cme_pointersize.UNIT}} !important;width:{{qanva_cme_pointersize.SIZE}}{{qanva_cme_pointersize.UNIT}} !important;',
     ],
     'condition' => [
					'qanva_cme_use' => 'yes', 
				],
			]
    );
				
		$this->add_control(
			'qanva_cme_cursorsize',
			[
				'label' => __( 'Outer size', 'qanva-custom-mouse-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
       'min' => 0,
							'max' => 50,
							'step' => 1,
					],
    ],
    'default' => [
						'unit' => 'px',
						'size' => 35,
					],
				'size_units' => [ 'px' ],
    'condition' => [
					'qanva_cme_use' => 'yes', 
				],
			]
    );
				
		$this->add_control(
			'qanva_cursor_demo',
			[
				'label' => '<span class="elementor-panel-heading-title">' . __( 'Preview', 'qanva-custom-mouse-for-elementor' ) . '</span>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
    'raw' => '<div class="elementor-control-field-description">' . '<div id="qanvamousewrapper"><div class="prevouter"><div class="prevpointer"></div></div></div>' . __( 'The custom cursor is not working in the development window, only in preview and frontend', 'qanva-custom-mouse-for-elementor' ) . '!<br>' . __( 'Our icon is only visible in the developer window, not in the frontend', 'qanva-custom-mouse-for-elementor' ) . '!</div>',
				'show_label' => true,
				'separator' => 'before',
			]
		);			
		
		$this->add_control(
			'qanva_cursor_info',
			[
				'label' => '<span class="elementor-panel-heading-title">' . __( 'Important', 'qanva-custom-mouse-for-elementor' ) . '!</span>',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
    'raw' => '<div class="elementor-control-field-description">' . __( 'Don\'t forget to add' , 'qanva-custom-mouse-for-elementor' ) . ' <span style="color:red;cursor:pointer" onclick="navigator.clipboard.writeText(\'qanva-hover\')">qanva-hover</span> ' . __( 'as class to links that you want to have the Qanva Mouse Cursor effect!' , 'qanva-custom-mouse-for-elementor' ) . '<br>' . __( 'For elements or areas that should show the standard mouse, add' , 'qanva-custom-mouse-for-elementor' ) . ' <span style="color:red;cursor:pointer" onclick="navigator.clipboard.writeText(\'qanva-no-hover\')">qanva-no-hover</span> ' . __( 'as class' , 'qanva-custom-mouse-for-elementor' ) . '!<hr><div class="qanva-ad">' . __( 'Find more tools at our homepage ' , 'qanva-custom-mouse-for-elementor' ) . '<a href="https://qanva.tech" target="_blank">Qanva.tech</a></div></div>',
				'show_label' => true,
				'separator' => 'before',
			]
		);

		 $this->end_controls_section();
	}
	
		protected function render(){
			$settings = $this->get_settings_for_display();
			if('yes' == $settings['qanva_cme_use']){
				wp_register_script( 'qanva-mouse-js', plugin_dir_url(__FILE__) . 'js/qanvamouse.js', [ 'elementor-frontend','jquery' ], '1.0.0', true );
				wp_register_style( 'qanvamousestyle', plugin_dir_url(__FILE__) . 'css/qanvamousecss.css');
				
				if( isset($_GET[ 'action' ]) && 'elementor' == $_GET[ 'action' ] ) {
					echo '<i id="qanva-mouse-prev-ico" class="eicon-dot-circle-o" style="color:rgba(100,100,100,0.3);display:inherit;font-size:22px;text-align:center;padding:5px 0;"></i>'; 
				}
		
				echo '<script type="text/javascript">
				qanvamouseoptions = {
					"outerWidth": ' . esc_html($settings['qanva_cme_cursorsize']['size']) . ',
					"outerHeight": ' . esc_html($settings['qanva_cme_cursorsize']['size']) .'
				};
				</script>';
			}
			if('no' == $settings['qanva_cme_use']){
				echo '&nbsp;';
			}
		}
		
		public function get_script_depends(){
			return [ 'qanva-mouse-js' ];
		}

		public function get_style_depends(){
			return [ 'qanvamousestyle' ];
		}
}