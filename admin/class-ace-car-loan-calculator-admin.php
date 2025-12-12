<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://acewebx.com
 * @since      1.0.0
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/admin
 * @author     AceWebx Team <developer@acewebx.com>
 */
if (! defined('WPINC')) {
	die;
}
class Ace_Car_Loan_Calculator_Admin
{

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
		 * defined in Ace_Car_Loan_Calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ace_Car_Loan_Calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$admin_css_file = plugin_dir_path(__FILE__) . 'css/ace-car-loan-calculator-admin.css';
		$admin_css_ver  = file_exists($admin_css_file) ? filemtime($admin_css_file) : $this->version;

		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url(__FILE__) . 'css/ace-car-loan-calculator-admin.css',
			array(),
			$admin_css_ver,
			'all'
		);
		$admin_css_file = plugin_dir_path(__FILE__) . 'css/classic.css';
		$admin_css_ver  = file_exists($admin_css_file) ? filemtime($admin_css_file) : $this->version;

		wp_enqueue_style(
			'pickr-mini-css',
			plugin_dir_url(__FILE__) . 'css/classic.css',
			array(),
			$admin_css_ver,
			'all'
		);
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
		 * defined in Ace_Car_Loan_Calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ace_Car_Loan_Calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$admin_js_file = plugin_dir_path(__FILE__) . 'js/ace-car-loan-calculator-admin.js';
		$admin_js_ver  = file_exists($admin_js_file) ? filemtime($admin_js_file) : $this->version;
		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url(__FILE__) . 'js/ace-car-loan-calculator-admin.js',
			array('jquery'),
			$admin_js_ver,
			false
		);
		$admin_js_file = plugin_dir_path(__FILE__) . 'js/pickr.js';
		$admin_js_ver  = file_exists($admin_js_file) ? filemtime($admin_js_file) : $this->version;
		wp_enqueue_script(
			'pickr-mini-js',
			plugin_dir_url(__FILE__) . 'js/pickr.js',
			array('jquery'),
			$admin_js_ver,
			false
		);
	}

	public function add_menu()
	{
		add_menu_page(
			'Ace Car Loan Calculator',
			'Ace Car Loan Calculator',
			'manage_options',
			'car-loan-calculator',
			[$this, 'settings_page'],
			'dashicons-calculator',
			17
		);
	}

	public function register_settings()
	{
		$settings = [
			// Numeric and boolean settings
			'ace_car_price'          => 'absint',
			'ace_trade_in'           => 'floatval',
			'ace_trade_in_allowance' => 'absint',
			'ace_tax_rate'           => 'floatval',
			'ace_down_payment'       => 'absint',
			'ace_cash_rebates'       => 'absint',
			'ace_loan_term'          => 'absint',
			'ace_loan_term_year'     => 'floatval',
			'ace_interest_rate'      => 'floatval',
			'ace_enable_pie_chart'   => 'absint',
			'ace_enable_trade_in'    => 'floatval',
			'ace_enable_term'        => 'absint',

			// Dropdown and text inputs
			'ace_currency_symbol'    => 'sanitize_text_field',
			'ace_amortization_type'  => 'sanitize_text_field',

			// Label / Text fields
			'ace_label_car_price'          => 'sanitize_text_field',
			'ace_label_trade_in'           => 'sanitize_text_field',
			'ace_label_trade_in_allowance' => 'sanitize_text_field',
			'ace_label_tax_rate'           => 'sanitize_text_field',
			'ace_label_down_payment'       => 'sanitize_text_field',
			'ace_label_cash_rebates'       => 'sanitize_text_field',
			'ace_label_loan_term'          => 'sanitize_text_field',
			'ace_label_interest_rate'      => 'sanitize_text_field',
			'ace_label_heading'            => 'sanitize_text_field',

			// Color settings
			'ace_heading_color'      => 'sanitize_hex_color',
			'ace_button_color'       => 'sanitize_hex_color',
			'ace_heading_textcolor'  => 'sanitize_hex_color',
		];

		foreach ($settings as $key => $sanitize_callback) {
			register_setting('ace_settings_group', $key, [
				'sanitize_callback' => $sanitize_callback
			]);
		}
	}

	public function settings_page()
	{
		require_once plugin_dir_path(__FILE__) . 'partials/ace-car-loan-calculator-admin-display.php';
	}
}
