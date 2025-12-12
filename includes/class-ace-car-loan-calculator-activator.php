<?php

/**
 * Fired during plugin activation
 *
 * @link       https://acewebx.com
 * @since      1.0.0
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/includes
 * @author     AceWebx Team <developer@acewebx.com>
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
class Ace_Car_Loan_Calculator_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$defaults = [
			'ace_heading_textcolor' => '#000000',
			'ace_heading_color'     => '#CBCBCB',
			'ace_button_color'      => '#0f8bd9ff',
			'ace_currency_symbol'   => '₹',
			'ace_amortization_type' => 'both',
			'ace_car_price'         => 50000,
			'ace_trade_in'          => 0,
			'ace_trade_in_allowance'=> 0,
			'ace_tax_rate'          => 8.88,
			'ace_down_payment'      => 10000,
			'ace_cash_rebates'      => 0,
			'ace_loan_term'         => 60,
			'ace_loan_term_year'    => 5,
			'ace_interest_rate'     => 5.6,
			'ace_enable_pie_chart'  => 1,
			'ace_enable_trade_in'   => 1,
			'ace_enable_term'       => 1,
	
			// Default labels
			'ace_label_car_price'          => 'Car Price',
			'ace_label_trade_in'           => 'Trade-in Value',
			'ace_label_trade_in_allowance' => 'Trade-in Allowance',
			'ace_label_tax_rate'           => 'Tax Rate',
			'ace_label_down_payment'       => 'Down Payment',
			'ace_label_cash_rebates'       => 'Cash Rebates',
			'ace_label_loan_term'          => 'Loan Term',
			'ace_label_interest_rate'      => 'Interest Rate',
			'ace_label_heading'            => 'Car Loan Calculator',
		];
	
		foreach ($defaults as $key => $value) {
			if (get_option($key) !== false) {
				delete_option($key);
			}
			add_option($key, $value);
		}
	}

}
