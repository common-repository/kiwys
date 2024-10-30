<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Kiwys_Lite
 * @subpackage Kiwys_Lite/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Kiwys_Lite
 * @subpackage Kiwys_Lite/admin
 * @author     Your Name <email@example.com>
 */
class Kiwys_Lite_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $kiwys_lite    The ID of this plugin.
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

	private $client;
	private $user;
	private $website;
	private $categories;
	private $metrics;
	private $adstxt;

	const TOKEN_OPTION_NAME = 'kiwys-lite-token';
	const WIDGET_ID_OPTION_NAME = 'kiwys-lite-id';
	const ACTIVE_POST_TYPES_OPTION_NAME = 'kiwys-lite-active-post-types';
	const MONETIZATION_ACTIVATED_OPTION_NAME = 'kiwys-lite-monetization-activated';
	const OVERRIDE_CATEGORY_OPTION_NAME = 'kiwys-lite-override-category';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->adstxt = "";
		$this->metrics = [
			"requests" => 0,
			"opportunities" => 0,
			"visibility" => 0,
			"impressions" => 0,
			"fillrate" => 0,
			"cpm" => 0,
			"earnings" => 0,
		];

		require_once plugin_dir_path(__FILE__) . '../includes/kiwys-api-client.php';
		$this->client = new KiwysApiClient("https://ads.kiwys.com/api");
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->plugin_name . '-tailwind', plugin_dir_url(__FILE__) . 'css/tailwind.min.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-core', plugin_dir_url(__FILE__) . 'css/kiwys-lite-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in PKiwys_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kiwys_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name . '-core', plugin_dir_url(__FILE__) . 'js/kiwys-lite-admin.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . '-font-awesome', plugin_dir_url(__FILE__) . 'js/font-awesome-all.js', [], $this->version, false);
	}

	/**
	 * Create the Kiwys Lite menu page with add_menu_page()
	 *
	 * @since    1.0.0
	 */
	public function add_admin_page()
	{
		add_menu_page(
			'Kiwys',
			'Kiwys',
			'manage_options',
			$this->plugin_name,
			array($this, 'load_admin_page_content'), // Calls function to require the partial
			'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhbHF1ZV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48cGF0aCBjbGFzcz0ic3QwIiBkPSJNNTA1LDEyMC44YzAuNCwxMS4yLTMuNiwxNy43LTExLjksMTkuNWMtNDEuNSw5LjctODcuOSwyNi40LTEzOS4yLDQ5LjhjLTc3LjYsMzUuOC0xMzguNyw2Ny41LTE4My4xLDk1LjNjMTAuMSwyOC4yLDIxLjMsNTQuNCwzMy42LDc4LjVjMjMuMSw0NC4xLDQzLjEsNjYuNCw2MC4xLDY3LjJjMTkuMSwwLjcsNDAuOC04LjgsNjUtMjguN2MxOS4xLTE1LjksMzIuOS0zMS4yLDQxLjItNDZjMS4xLTEuNCwyLjItMi4yLDMuMi0yLjJjMi45LDAsNS44LDIuOSw4LjcsOC43YzIuOSw1LjgsNC4zLDExLDQuMywxNS43YzAsMi4yLTAuNCwzLjgtMS4xLDQuOWMtMTAuNSwyMS4zLTI2LjIsNDIuMS00Ny4xLDYyLjNjLTI4LjksMjcuMS01Ni45LDQwLjMtODQsMzkuNWMtNDQuNC0xLjQtODYuMS0zMy4yLTEyNS4xLTk1LjNjLTguMy0xMy0xNS41LTI4LjItMjEuNy00NS41Yy0zNC4zLDYzLjYtNTMuOCwxMDMuOC01OC41LDEyMC44Yy0xLjEsNC4zLTEuNiw4LjMtMS42LDExLjljMCwyLjUsMC40LDUuOCwxLjEsOS43YzAuNywyLjUsMC42LDQuMS0wLjMsNC42Yy0wLjksMC41LTIuMSwwLjgtMy41LDAuOGMtNi4xLDAtMTIuNS0zLjYtMTktMTAuOGMtMTMuNC0xNS45LTIwLTI3LjgtMjAtMzUuOGMwLTIyLjgsMzAuNy05Ny42LDkyLjEtMjI0LjVjNjEuNC0xMjYuOSw5OS4zLTE5NCwxMTMuNy0yMDEuMmMxLjEtMC43LDIuMy0xLjEsMy44LTEuMWM4LjMsMCwxOC45LDUuNSwzMS43LDE2LjVjMTIuOCwxMSwyMC43LDIxLjIsMjMuNiwzMC42YzEuOCw2LjksMS4xLDEyLjEtMi4yLDE1LjdjLTE5LjUsMjAuOS01NC4yLDc0LjgtMTA0LDE2MS40YzE5LjktMTguNCw0Ni40LTQwLjMsNzkuNi02NS41YzQwLjQtMzAuNyw3NS4zLTU0LjUsMTA0LjUtNzEuNWM1OC4xLTMzLjIsOTYuMi00OS44LDExNC4zLTQ5LjhjMi45LDAsNS40LDAuNSw3LjYsMS42YzcuNiwyLjksMTUuMSwxMS4yLDIyLjUsMjQuOUM1MDAuNyw5Ni43LDUwNC42LDEwOS4zLDUwNSwxMjAuOHoiLz48L3N2Zz4='
		);
	}

	/**
	 * Load the plugin admin page partial.
	 *
	 * @since    1.0.0
	 */
	public function load_admin_page_content()
	{
		// auth
		$token = get_option(self::TOKEN_OPTION_NAME);
		if ($token !== false) {
			$user = $this->client->getUser($token);
			if (is_wp_error($user) || !$user) {
				delete_option(self::TOKEN_OPTION_NAME);
			} else {
				$this->user = $user;
				$this->categories = $this->client->getCategories($token);

				$website = $this->client->getWebsite($token, parse_url(get_site_url(), PHP_URL_HOST));
				if (is_wp_error($website) || isset($website["message"])) {
					$website = null;
					delete_option(self::WIDGET_ID_OPTION_NAME);
				} else {
					$this->website = $website;
					if (isset($this->website["widgets"], $this->website["widgets"][0])) {
						update_option(self::WIDGET_ID_OPTION_NAME, $this->website["widgets"][0]["id"], false);
					}
				}

				$metrics = $this->client->getMetrics($token, $this->website["widgets"][0]["id"]);
				if (!is_wp_error($metrics)) {
					$this->metrics = $metrics;
				}
			}
		}

		require_once plugin_dir_path(__FILE__) . 'partials/kiwys-lite-admin-display.php';
	}

	public function post_login()
	{
		status_header(200);
		if (isset($_POST['kiwys-lite-nonce'])) {
			if (wp_verify_nonce($_POST['kiwys-lite-nonce'], 'kiwys-lite-nonce')) {
				if (isset($_POST["email"], $_POST["password"])) {
					$email = sanitize_email($_POST["email"]);
					$email = $this->validate("email", $email);
					if ($email !== false) {
						$password = sanitize_text_field($_POST["password"]);
						$token = $this->client->authenticate($email, $password);
						if (isset($token["access_token"])) {
							update_option(self::TOKEN_OPTION_NAME, $token["access_token"], false);
						}
					}
				}
			}
		}
		wp_redirect(admin_url('admin.php?page=kiwys-lite'));
		die();
	}

	public function post_logout()
	{
		status_header(200);
		if (isset($_POST['kiwys-lite-nonce'])) {
			if (wp_verify_nonce($_POST['kiwys-lite-nonce'], 'kiwys-lite-nonce')) {
				delete_option(self::TOKEN_OPTION_NAME);
			}
		}

		wp_redirect(admin_url('admin.php?page=kiwys-lite'));
		die();
	}

	public function post_update()
	{
		status_header(200);
		if (isset($_POST['kiwys-lite-nonce'])) {
			if (wp_verify_nonce($_POST['kiwys-lite-nonce'], 'kiwys-lite-nonce')) {
				if (isset($_POST["post_types"])) {
					$postTypes = array_keys(get_post_types(['public'   => true], 'objects'));
					$activePosts = [];
					foreach ($_POST["post_types"] as $type => $value) {
						if ($this->validate("in", $type, $postTypes) && $this->validate("boolean", $value)) {
							$activePosts[] = $type;
						}
					}
					update_option(self::ACTIVE_POST_TYPES_OPTION_NAME, $activePosts, false);
				} else {
					delete_option(self::ACTIVE_POST_TYPES_OPTION_NAME);
				}

				if ($this->validate("boolean", $_POST["activate"] || false)) {
					update_option(self::MONETIZATION_ACTIVATED_OPTION_NAME, true, false);
				} else {
					delete_option(self::MONETIZATION_ACTIVATED_OPTION_NAME);
				}

				if (isset($_POST["category"])) {
					$category = sanitize_text_field($_POST["category"]);
					$category = $this->validate("number", $category);
					if ($category !== false) {
						if ($category !== 0) {
							update_option(self::OVERRIDE_CATEGORY_OPTION_NAME, $category, false);
						} else {
							delete_option(self::OVERRIDE_CATEGORY_OPTION_NAME);
						}
					}
				}
			}
		}

		wp_redirect(admin_url('admin.php?page=kiwys-lite'));
		die();
	}

	private function bd_nice_number($n)
	{
		// first strip any formatting;
		$n = (0 + str_replace(",", "", $n));

		// is this a number?
		if (!is_numeric($n)) return false;

		// now filter it;
		if ($n > 1000000000000) return round(($n / 1000000000000), 1) . 'T';
		else if ($n > 1000000000) return round(($n / 1000000000), 1) . 'G';
		else if ($n > 1000000) return round(($n / 1000000), 1) . 'M';
		else if ($n > 1000) return round(($n / 1000), 1) . 'k';

		return number_format($n);
	}

	private function filter($value, $filter)
	{
		switch ($filter) {
			case "currency":
				if ($value === 0) {
					return "-";
				}
				return number_format($value, 2, ',', ' ') . "€";
				break;
			case "percentage":
				if ($value === 0) {
					return "-";
				}
				return number_format($value * 100, 0, ',', ' ') . "%";
				break;
			case "bigNumber":
				if ($value === 0) {
					return "-";
				}
				return $this->bd_nice_number($value);
				break;
			default:
				return $value;
		}
	}

	private function validate($type, $value, $options = null)
	{
		switch ($type) {
			case "email":
				return filter_var($value, FILTER_VALIDATE_EMAIL);
			case "number":
				return filter_var($value, FILTER_VALIDATE_INT);
			case "boolean":
				return filter_var($value, FILTER_VALIDATE_BOOLEAN);
			case "in":
				return in_array($value, $options);
		}
	}
}
