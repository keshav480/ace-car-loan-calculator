<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://acewebx.com
 * @since      1.0.0
 *
 * @package    Ace_Car_Loan_Calculator
 * @subpackage Ace_Car_Loan_Calculator/admin/partials
 */
if (! defined('WPINC')) {
	die;
}
?>
<div class="main-outer">
	<div class="inner-section">
		<div class="right-div">
			<h1>Ace Car Loan Calculator – Settings</h1>
		</div>
		<div class="left-div">
			<input type="text" id="car-loan-shortcode" value="[car_loan_calculator]" readonly class="cc_input" style="max-width: 250px;" />
			<button type="button" class="cc_button" id="copy-btn">Copy</button>
		</div>
	</div>
	<form id="settingform" method="post" action="options.php">
		<?php settings_fields('ace_settings_group'); ?>
		<?php do_settings_sections('ace_settings_group'); ?>
		<div class="div-outer-section">
			<div class="outer-section">
				<h2 class="title">General Settings</h2>
				<div class="cc_form_group">
					<div class="cc_currency_group">
						<label for="ace_currency_symbol">Currency Symbol</label>
						<select id="ace_currency_symbol" name="ace_currency_symbol">
							<?php $current_symbol = get_option('ace_currency_symbol', '₹'); ?>
							<option value="₹" <?php selected($current_symbol, '₹'); ?>>Rupee (₹)</option>
							<option value="$" <?php selected($current_symbol, '$'); ?>>Dollar ($)</option>
							<option value="£" <?php selected($current_symbol, '£'); ?>>Pound (£)</option>
						</select>
					</div>
					<?php
					$number_fields = [
						'ace_car_price' => 'Car Price',
						'ace_trade_in' => 'Trade-in Value',
						'ace_trade_in_allowance' => 'Trade-in Tax Allowance',
						'ace_tax_rate' => 'Tax Rate (%)',
						'ace_down_payment' => 'Down Payment',
						'ace_cash_rebates' => 'Cash Rebates',
						'ace_loan_term' => 'Loan Term (Months)',
						'ace_loan_term_year' => 'Loan Term (Years)',
						'ace_interest_rate' => 'Interest Rate (%)'
					];

					$decimal_fields = [
						'ace_interest_rate',
						'ace_tax_rate',
						'ace_loan_term_year',
						'ace_trade_in'
					];

					foreach ($number_fields as $key => $label) {
						$step = in_array($key, $decimal_fields, true) ? '0.01' : '1';
					?>
						<div class="cc_input_group">
							<label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label>
							<input
								type="number"
								step="<?php echo esc_attr($step); ?>"
								min="0"
								id="<?php echo esc_attr($key); ?>"
								name="<?php echo esc_attr($key); ?>"
								value="<?php echo esc_attr(get_option($key)); ?>" />
						</div>
					<?php } ?>


				</div>
			</div>
			<div class="outer-section">
				<h2 class="title">Display Settings</h2>
				<div class="cc_form_group two-column-layout">
					<div class="form_column left_column">
						<?php
						$checkboxes = [
							'ace_enable_pie_chart' => 'Enable Pie Chart',
							'ace_enable_trade_in' => 'Enable Loan Details',
							'ace_enable_term' => 'Enable Loan Term (Year Input)',
						];
						foreach ($checkboxes as $key => $label) :
						?>
							<div class="cc_input_group">
								<label>
									<input type="hidden" name="<?php echo esc_attr($key); ?>" value="0">
									<input type="checkbox" name="<?php echo esc_attr($key); ?>" value="1" <?php checked(1, get_option($key)); ?>>
									<?php echo esc_html($label); ?>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="form_column right_column">
						<div class="cc_input_group">
							<label for="ace_amortization_type">Amortization Display Type</label>
							<select id="ace_amortization_type" name="ace_amortization_type">
								<?php $current = get_option('ace_amortization_type', 'both'); ?>
								<option value="both" <?php selected($current, 'both'); ?>>Both</option>
								<option value="monthly" <?php selected($current, 'monthly'); ?>>Monthly</option>
								<option value="annual" <?php selected($current, 'annual'); ?>>Annual</option>
							</select>
						</div>
						<!-- Color Settings -->
						<?php
						$color_fields = [
							'ace_heading_textcolor' => 'Heading Text Color',
							'ace_heading_color'     => 'Heading Background Color',
							'ace_button_color'      => 'Button Background Color',
						];

						$default_colors = [
							'ace_heading_textcolor' => '#000000',
							'ace_heading_color'     => '#CBCBCB',
							'ace_button_color'      => '#0f8bd9ff',
						];

						foreach ($color_fields as $key => $label) {
							$value = get_option($key);
							if ($value === false || $value === '') {
								$value = $default_colors[$key];
							}
						?>
							<div class="cc_input_group" style="margin-bottom:15px;">
								<label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label>
								<div class="inner-color">
									<div class="color-picker" id="<?php echo esc_attr($key); ?>_picker"></div>
									<input type="text"
										id="<?php echo esc_attr($key); ?>_text"
										name="<?php echo esc_attr($key); ?>"
										value="<?php echo esc_attr($value); ?>"
										class="color-input" />
								</div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<!-- Labels Section -->
		<div class="label-section">
			<h2 class="title">Label/Heading Settings</h2>
			<div class="cc_form_group">
				<?php
				$label_fields = [
					'ace_label_car_price'          => 'Car Price Label',
					'ace_label_trade_in'           => 'Trade-in Value Label',
					'ace_label_trade_in_allowance' => 'Trade-in Allowance Label',
					'ace_label_tax_rate'           => 'Tax Rate Label',
					'ace_label_down_payment'       => 'Down Payment Label',
					'ace_label_cash_rebates'       => 'Cash Rebates Label',
					'ace_label_loan_term'          => 'Loan Term Label',
					'ace_label_interest_rate'      => 'Interest Rate Label',
					'ace_label_heading'            => 'Main Heading',
				];
				foreach ($label_fields as $key => $label) {
				?>
					<div class="cc_input_group">
						<label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label>
						<input type="text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr(get_option($key)); ?>" />
					</div>
				<?php } ?>
			</div>
		</div>
		<?php submit_button('Save Settings'); ?>
	</form>
</div>

<!-- This file should primarily consist of HTML with a little bit of PHP.  -->