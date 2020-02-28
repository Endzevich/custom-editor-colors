<?php

namespace BlockEditorColors;

class BlockEditorColors {

	private $plugin_textdomain = 'block-editor-colors';
	private static $_instance = null;

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {
		add_action( 'init', array( $this, 'setup_color_service' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'plugin_action_links_' . plugin_basename( BEC_PLUGIN_FILE ), array( $this, 'action_links' ) );
	}

	public function setup_color_service() {
		include_once dirname( __FILE__ ) . '/ColorService.php';
		include_once dirname( __FILE__ ) . '/admin/AdminPages.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin_textdomain, false, dirname( plugin_basename( BEC_PLUGIN_FILE ) ) . '/languages/' );
	}

	public function action_links( $links ) {

		$settings_page_url = SettingsPage::getAdminUrl();

		$plugin_links = array(
			'<a href=' . esc_url( $settings_page_url ) . '>' . esc_html__( 'Settings', 'block-editor-colors' ) . '</a>'
		);

		return array_merge( $links, $plugin_links );
	}

}