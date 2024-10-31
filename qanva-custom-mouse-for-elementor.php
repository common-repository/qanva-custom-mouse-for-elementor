<?php
/**
 * Plugin Name: Qanva Custom Mouse for Elementor
 * Description: Enable a custom look for the mouse with a special hover effect
 * Plugin URI:  https://qanva.tech/qanva-custom-mouse-for-elementor
 * Version:     1.0.2
 * Author:      ukischkel, qanva.tech
 * Author URI:  https://qanva.tech
 * License:		   GPL v2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: qanva-custom-mouse-for-elementor
 * Domain Path: languages
 * Elementor tested up to: 3.15.3
 * Elementor Pro tested up to: 3.15.1
 */
namespace MAKECUSTOMMOUSE;

	define( 'MAKECUSTOMMOUSEVERSION', '1.0.2' );
  
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
	
    $desc = __( 'Enable a custom look for the mouse with a special hover effect', 'qanva-custom-mouse-for-elementor' );

final class MAKECUSTOMMOUSEELEMENTOR{
	const  MINIMUM_ELEMENTOR_VERSION = '2.0.0' ;
  const  MINIMUM_PHP_VERSION = '7.0' ;
  private static  $_instance = null ;
    public static function instance(){
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct(){
        add_action( 'plugins_loaded', [ $this,'ladesprachdateifuercustommouseforelementor'] );
        add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
    }
    
    public function ladesprachdateifuercustommouseforelementor() {
      $pfad = dirname( plugin_basename(__FILE__) ) . '/languages/';
      load_plugin_textdomain( 'qanva-custom-mouse-for-elementor', false, $pfad );
    } 

    
    public function on_plugins_loaded(){
        if ( $this->is_compatible() ) {
            add_action( 'elementor/init', [ $this, 'init' ] );
        }
    }
    
    
		/** Check required min versions **/
    public function is_compatible(){     
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return false;
        }
        if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return false;
        }
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return false;
        }        
        return true;
    }
    
    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
          esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'qanva-custom-mouse-for-elementor' ),
          '<strong>' . esc_html__( 'Custom Mouse for Elementor', 'qanva-custom-mouse-for-elementor' ) . '</strong>',
          '<strong>' . esc_html__( 'Elementor', 'qanva-custom-mouse-for-elementor' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
    
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
          esc_html__( '"%1$s" requires min version "%2$s" of Elementor to be installed.', 'qanva-custom-mouse-for-elementor' ),
          '<strong>' . esc_html__( 'Custom Mouse for Elementor', 'qanva-custom-mouse-for-elementor' ) . '</strong>',
          '<strong>' . MINIMUM_ELEMENTOR_VERSION . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
    
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
          esc_html__( '"%1$s" requires min PHP version "%2$s" running.', 'qanva-custom-mouse-for-elementor' ),
          '<strong>' . esc_html__( 'Custom Mouse for Elementor', 'qanva-custom-mouse-for-elementor' ) . '</strong>',
          '<strong>' . MINIMUM_PHP_VERSION . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
    
		public function init(){
    add_action( 'elementor/widgets/register', [ $this, 'register_widgets_cme' ] );
    add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'custommouse_styles' ] );
				add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'custommouse_scripts' ] );
		}
		
		    
    /** Widgets **/		
    private function custommouse_init_controls() {
      require_once( __DIR__ . '/controls/custom-mouse-control.php' );
    }		
    
    public function register_widgets_cme(){
      $this->custommouse_init_controls();
        \Elementor\Plugin::instance()->widgets_manager->register( new Widgets\MAKECUSTOMMOUSEFORTHEELEMENTOR() );
    }
       
	
		public function custommouse_styles() {
			wp_enqueue_style( 'custommouseprev', plugins_url( 'controls/css/qanvamouseprev.css', __FILE__ ), [ 'elementor-editor' ], MAKECUSTOMMOUSEVERSION);
		}

		public function custommouse_scripts() {
			wp_enqueue_script( 'custommouseprev_js', plugins_url( 'controls/js/qanvamouseprev.js', __FILE__ ),[ 'jquery' ],MAKECUSTOMMOUSEVERSION,true );
		}	
		
}

 MAKECUSTOMMOUSEELEMENTOR::instance();
 