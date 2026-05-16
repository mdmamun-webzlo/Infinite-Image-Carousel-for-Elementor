<?php
/**
 * Plugin Name: Infinite Image Carousel
 * Description: Elementor widget for infinite vertical and horizontal image carousel with dynamic columns.
 * Version: 1.1.0
 * Author: Md Mamun Miah, Lead Web & WordPress Developer | Founder, Webzlo | High-Converting Business & E-commerce Websites
 * Author URI: https://webzlo.com
 * Text Domain: iic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class IIC_Plugin {

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'missing_elementor_notice' ] );
			return;
		}

		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
	}

	public function missing_elementor_notice() {
		if ( current_user_can( 'activate_plugins' ) ) {
			echo '<div class="notice notice-warning is-dismissible"><p>';
			echo esc_html__( 'Infinite Image Carousel requires Elementor to be installed and activated.', 'iic' );
			echo '</p></div>';
		}
	}

	public function register_widget( $widgets_manager ) {
		require_once __DIR__ . '/widget.php';

		if ( class_exists( '\IIC_Infinite_Image_Carousel' ) ) {
			$widgets_manager->register( new \IIC_Infinite_Image_Carousel() );
		}
	}
}

new IIC_Plugin();