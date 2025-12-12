<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://acewebx.com
 * @since      1.0.0
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/public/partials
 */
if (! defined('WPINC')) {
	die;
}
$car_price          = get_option('ace_car_price', 50000);
$trade_in           = get_option('ace_trade_in', 0);
$trade_in_allowance = get_option('ace_trade_in_allowance', 0);
$tax_rate           = get_option('ace_tax_rate', 8.88);
$down_payment       = get_option('ace_down_payment', 10000);
$cash_rebates       = get_option('ace_cash_rebates', 0);
$loan_term          = get_option('ace_loan_term', 60);
$interest_rate      = get_option('ace_interest_rate', 5.6);
$currency_symbol    = get_option('ace_currency_symbol', '$');
$load_term_year    = get_option('ace_loan_term_year', 5);
$enable_loandetails    = get_option('ace_enable_trade_in', 1);
$enable_pie_chart   = get_option('ace_enable_pie_chart', 1);
$enable_table       = get_option('ace_amortization_type', 'both');
$enable_term_year   = get_option('ace_enable_term', 0);
// labels
$lbl_car_price      = get_option('ace_label_car_price', 'Car Price');
$lbl_trade_in       = get_option('ace_label_trade_in', 'Trade-in Value');
$lbl_trade_allow    = get_option('ace_label_trade_in_allowance', 'Trade-in Tax Allowance');
$lbl_tax_rate       = get_option('ace_label_tax_rate', 'Tax Rate (%)');
$lbl_down_payment   = get_option('ace_label_down_payment', 'Down Payment');
$lbl_cash_rebates   = get_option('ace_label_cash_rebates', 'Cash Rebate and Incentives');
$lbl_loan_term      = get_option('ace_label_loan_term', 'Loan Term (Months)');
$lbl_interest_rate  = get_option('ace_label_interest_rate', 'Interest Rate (%)');
$heading  = get_option('ace_label_heading', 'Car Loan Calculator');
$heading_color  = get_option('ace_heading_color', '#CBCBCB;');
$button_color  = get_option('ace_button_color', '#fba32e;');
$heading_text_color  = get_option('ace_heading_textcolor', '#fba32e;');
?>
<div class="clc-container">
	<div class="calculator-wrapper">
		<h4 id="main-heading" style="background-color: <?php echo esc_attr($heading_color); ?>; color: <?php echo esc_attr($heading_text_color); ?>;">
			<?php echo esc_html($heading); ?>
		</h4>
		<div class="ace_outer_section">
			<div class="ace_inner_section">
				<div class="ace_left_div">
					<div class="ace_input_wrapper">
						<label for="car-price"><?php echo esc_html($lbl_car_price); ?></label>
						<input type="text" id="car-price" class="ace_input" value="<?php echo esc_attr($currency_symbol . number_format($car_price)); ?>">
					</div>
				</div>
				<div class="ace_right_div">
					<div class="ace_input_wrapper">
						<label for="trade-in-value"><?php echo esc_html($lbl_trade_in); ?></label>
						<input type="text" id="trade-in-value" class="ace_input" value="<?php echo esc_attr($currency_symbol . $trade_in); ?>">
					</div>
				</div>
			</div>
			<div class="ace_inner_section">
				<div class="ace_left_div">
					<div class="ace_input_wrapper">
						<label for="trade-in-tax-allowance"><?php echo esc_html($lbl_trade_allow); ?></label>
						<input type="text" id="trade-in-tax-allowance" class=" ace_input" value="<?php echo esc_attr($currency_symbol . number_format($trade_in_allowance)); ?>">
					</div>
				</div>
				<div class="ace_right_div">
					<div class="ace_input_wrapper">
						<label for="tax-rate"><?php echo esc_html($lbl_tax_rate); ?></label>
						<input type="number" id="tax-rate" class=" ace_input tax" value="<?php echo esc_attr($tax_rate); ?>" step="0.01" min="0">
					</div>
				</div>
			</div>
			<div class="ace_inner_section">
				<div class="ace_left_div">
					<div class="ace_input_wrapper">
						<label for="down-payment"><?php echo esc_html($lbl_down_payment); ?></label>
						<input type="text" id="down-payment" class=" ace_input" value="<?php echo esc_attr($currency_symbol . number_format($down_payment)); ?>">
					</div>
				</div>
				<div class="ace_right_div">
					<div class="ace_input_wrapper">
						<label for="cash-rebates"><?php echo esc_html($lbl_cash_rebates); ?></label>
						<input type="text" id="cash-rebates" class=" ace_input" value="<?php echo esc_attr($currency_symbol . number_format($cash_rebates)); ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="ace_additional-sec">
			<div class="interest-section">
				<div class="ace_left_div">
					<div class="ace_input_wrapper">
						<?php if ($enable_term_year): ?>
							<label for="loan-term"><?php echo esc_html($lbl_loan_term); ?> (Years)</label>
							<input type="number" id="loan-term-year" class="ace_input" value="<?php echo esc_attr($load_term_year); ?>" min="1">
						<?php else: ?>
							<label for="loan-term"><?php echo esc_html($lbl_loan_term); ?> (Months) </label>
							<input type="number" id="loan-term" class="ace_input" value="<?php echo esc_attr($loan_term); ?>" min="1">
						<?php endif; ?>
					</div>
				</div>
				<div class="ace_right_div">
					<div class="ace_input_wrapper">
						<label for="interest-rate"><?php echo esc_html($lbl_interest_rate); ?></label>
						<input type="number" id="interest-rate" class="ace_input" value="<?php echo esc_attr($interest_rate); ?>" step="0.01" min="0">
					</div>
				</div>
			</div>
			<div class="btn-section ">
				<button id="calculate" class="ace_button" style="background-color: <?php echo esc_html($button_color); ?>;">Calculate</button>
			</div>
		</div>
	</div>
	<div class="result-section hidden-section">
		<h4 class="paymentAmount" style="background-color: <?php echo esc_html($heading_color); ?>; color: <?php echo esc_attr($heading_text_color); ?>;">
			<?php echo esc_attr($currency_symbol); ?>
		</h4>
		<div class="result-inner-section">
			<?php if ($enable_loandetails): ?>
				<div id="loan-detail" class="data ace_left_div">
					<div class="clc-table-wrapper">
						<table class="table loanData">
							<tbody></tbody>
						</table>
						<table class="table interestData">
							<tbody></tbody>
						</table>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($enable_pie_chart): ?>
				<div class="clc-table-wrapper">
					<div class="chart ace_left_div">
						<div id="pie-chart"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if (
			$enable_table === 'both' ||
			$enable_table === 'annual' ||
			$enable_table === 'monthly'
		): ?>
			<div class="amort-table">
				<h4 style="background-color: <?php echo esc_html($heading_color); ?>; color: <?php echo esc_attr($heading_text_color); ?>;">
					Amortization Schedule
				</h4>
				<div class="toggle_section ace_inner_section">
					<?php if ($enable_table === 'annual' || $enable_table === 'both'): ?>
						<div class="ace_left_div">
							<button id="annualSchedule" class="ace_result_button">Annual Schedule</button>
						</div>
					<?php endif; ?>
					<?php if ($enable_table === 'monthly' || $enable_table === 'both'): ?>
						<div class="ace_right_div">
							<button id="monthlySchedule" class="active ace_result_button">Monthly Schedule</button>
						</div>
					<?php endif; ?>
				</div>
				<div class="clc-table-wrapper">
					<table class="ace_table">
						<thead>
							<tr>
								<th id="termText">Month</th>
								<th>Interest</th>
								<th>Principal</th>
								<th>Ending Balance</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>