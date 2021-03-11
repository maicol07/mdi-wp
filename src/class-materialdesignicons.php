<?php
/**
 * MaterialDesignIcons class
 *
 * @package mdi-wp
 * @noinspection AutoloadingIssuesInspection
 */

/**
 * Class MaterialDesignIcons
 */
class MaterialDesignIcons {
	private const VERSION = '1.0.0a';

	/**
	 * MaterialDesignIcons constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'styles' ) );
		add_shortcode( 'mdi', array( $this, 'setup_shortcode' ) );
		add_filter( 'widget_text', 'do_shortcode' );
		add_action( 'admin_init', array( $this, 'add_tinymce_hooks' ) );
	}

	/**
	 * Add TinyMCE Hooks
	 */
	final public function add_tinymce_hooks(): void {
		// check user permissions.
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}

		// check if WYSIWYG is enabled.
		if ( 'true' === get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', array( $this, 'register_tinymce_plugin' ) );
			add_filter( 'mce_buttons', array( $this, 'add_tinymce_buttons' ) );
		}
	}

	/**
	 * Register plugin styles
	 */
	final public function styles(): void {
		wp_enqueue_style( 'material-design-icon-styles', plugins_url( 'css/materialdesignicons.min.css', __FILE__ ), array(), self::VERSION );
		wp_enqueue_style( 'material-design-icon-styles-admin', plugins_url( 'css/admin.css', __FILE__ ), array(), self::VERSION );
		wp_enqueue_style( 'material-design-icon-styles-size', plugins_url( 'css/size.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Setup shortcode
	 *
	 * @param array $params Parameters defined by the user in the shortcode tag.
	 *
	 * @return string
	 */
	final public function setup_shortcode( array $params ): string {
		$attr = shortcode_atts(
			array(
				'name'  => '',
				'color' => '',
				'size'  => '',
			),
			$params
		);

		$size  = $attr['size'] ? "mdi-{$attr['size']}" : '';
		$color = $attr['color'] ? 'style="color: ' . $attr['color'] . ';"' : '';

		return '<i class="mdi mdi-' . $params['name'] . ' ' . $size . '" ' . $color . '"></i>';
	}

	/**
	 * Declare script for new button
	 *
	 * @param array $plugin_array Buttons plugin.
	 *
	 * @return array
	 */
	final public function register_tinymce_plugin( array $plugin_array ): array {
		$plugin_array['mdi'] = plugins_url( 'js/tinymce.js', __FILE__ );

		return $plugin_array;
	}

	/**
	 * Register new buttons in editor
	 *
	 * @param array $buttons Buttons already added to the editor.
	 *
	 * @return array
	 */
	final public function add_tinymce_buttons( array $buttons ): array {
		$buttons[] = 'mdi';

		return $buttons;
	}
}
