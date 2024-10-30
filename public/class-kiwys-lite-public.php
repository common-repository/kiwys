<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Kiwys_Lite
 * @subpackage Kiwys_Lite/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Kiwys_Lite
 * @subpackage Kiwys_Lite/public
 * @author     Your Name <email@example.com>
 */
class Kiwys_Lite_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	const ACTIVE_POST_TYPES_OPTION_NAME = 'kiwys-lite-active-post-types';
	const MONETIZATION_ACTIVATED_OPTION_NAME = 'kiwys-lite-monetization-activated';
	const WIDGET_ID_OPTION_NAME = 'kiwys-lite-id';
	const OVERRIDE_CATEGORY_OPTION_NAME = 'kiwys-lite-override-category';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Kiwys_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kiwys_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Kiwys_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kiwys_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	}

	public function insert_widget() {
		$adSlotId = get_option(self::WIDGET_ID_OPTION_NAME, null);
		$overrideCategory = get_option(self::OVERRIDE_CATEGORY_OPTION_NAME, null);
		if($adSlotId !== null && get_option(self::MONETIZATION_ACTIVATED_OPTION_NAME, false) !== false && in_array(get_post_type(), get_option(self::ACTIVE_POST_TYPES_OPTION_NAME, []))){
			?>
				<script async src="<?php echo esc_url('https://cdn.kiwys.com/build/kiwys.min.js?slot=' . $adSlotId . ($overrideCategory !== null ? "&category=" . $overrideCategory : ":")); ?>"></script>
			<?php
		}
	}
	

}
