<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://acewebx.com
 * @since             1.0.0
 * @package           Ace_Car_Loan_Calculator
 *
 * @wordpress-plugin
 * Plugin Name:       Ace Car Loan Calculator
 * Plugin URI:        https://acewebx.com/ace-loan-calculator
 * Description:       A ace car loan calculator is a financial tool designed to help users estimate the cost of financing a vehicle. It calculates monthly payments, total interest, and the overall cost of a  car loan based on user-provided information.
It includes admin settings to configure default values, toggle features like charts, schedules, and customize the UI.
 * Version:           1.0.0
 * Author:            AceWebx Team
 * Author URI:        https://acewebx.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ace-car-loan-calculator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('ACE_CAR_LOAN_CALCULATOR_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ace-car-loan-calculator-activator.php
 */
function ace_car_loan_calculator_activate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-ace-car-loan-calculator-activator.php';
	Ace_Car_Loan_Calculator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ace-car-loan-calculator-deactivator.php
 */
function ace_car_loan_calculator_deactivate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-ace-car-loan-calculator-deactivator.php';
	Ace_Car_Loan_Calculator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'ace_car_loan_calculator_activate');
register_deactivation_hook(__FILE__, 'ace_car_loan_calculator_deactivate');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-ace-car-loan-calculator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function ace_car_loan_calculator_run()
{

	$plugin = new Ace_Car_Loan_Calculator();
	$plugin->run();
}
ace_car_loan_calculator_run();
