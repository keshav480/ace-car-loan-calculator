<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://acewebx.com
 * @since      1.0.0
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/public
 * @author     AceWebx Team <developer@acewebx.com>
 */
if (! defined('WPINC')) {
	die;
}
class Ace_Car_Loan_Calculator_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		$public_css_file = plugin_dir_path(__FILE__) . 'css/ace-car-loan-calculator-public.css';
		$public_css_ver  = file_exists($public_css_file) ? filemtime($public_css_file) : $this->version;

		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url(__FILE__) . 'css/ace-car-loan-calculator-public.css',
			array(),
			$public_css_ver,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		$pubic_js_file = plugin_dir_path(__FILE__) . 'js/ace-car-loan-calculator-public.js';
		$public_js_ver  = file_exists($pubic_js_file) ? filemtime($pubic_js_file) : $this->version;
		wp_enqueue_script(
			'clc-script',
			plugin_dir_url(__FILE__) . 'js/ace-car-loan-calculator-public.js',
			array('jquery'),
			$public_js_ver,
			false
		);
		wp_enqueue_script('jquery');

		$chartjs_file = plugin_dir_path(__FILE__) . 'js/chart.js';
		$chartjs_ver  = file_exists($chartjs_file) ? filemtime($chartjs_file) : $this->version;
		wp_enqueue_script(
			'chartjs',
			plugin_dir_url(__FILE__) . 'js/chart.js',
			[],
			$chartjs_ver,
			true
		);

		$settings = [
			'currency_symbol' => get_option('ace_currency_symbol', '$'),
			'enable_pie_chart' => (int) get_option('ace_enable_pie_chart', 1),
			'enable_amort' => (int) get_option('ace_enable_amort', 1),
			'enable_trade_in' => (int) get_option('ace_enable_trade_in', 1),
			'enable_term' => (int) get_option('ace_enable_term', 0),
			'ace_amortization_type' => get_option('ace_amortization_type', 'both'),
		];

		wp_localize_script('clc-script', 'ace_settings', $settings);
	}
	function render_shortcode()
	{
		ob_start();
		require_once plugin_dir_path(__FILE__) . '/partials/ace-car-loan-calculator-public-display.php';
		return ob_get_clean();
	}
}
