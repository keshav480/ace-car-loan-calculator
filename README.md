# Ace Car Loan Calculator

A simple and professional Car Loan Calculator for WordPress with shortcode support and admin settings.

## External Services

This plugin does not connect to any external services. Chart.js library is bundled locally with the plugin.

**Chart Library:** Chart.js (MIT Licensed)

Chart.js is bundled locally with the plugin for rendering the loan breakdown doughnut chart. No external resources or services are used.

**License:** Chart.js is provided under the MIT License, which is compatible with GPLv2+.
- Chart.js GitHub: https://github.com/chartjs/Chart.js
- Chart.js License: https://github.com/chartjs/Chart.js/blob/master/LICENSE.md

## Features

- Frontend shortcode `[car_loan_calculator]`
- Customizable defaults: car price, loan term, interest rate
- Toggle display of Doughnut Chart, Interest Data, Amortization Schedule
- Customize button colors and tooltip styles
- Uses WordPress settings API (stored in wp_options)
- GPL 2.0+ compatible with Chart.js (MIT license)

## Installation

1. Upload the plugin ZIP via **Plugins → Add New → Upload Plugin**
2. Activate the plugin
3. Configure settings via **Admin → Car Loan Calculator**
4. Add the shortcode `[car_loan_calculator]` to any page or post

## Usage

Use the shortcode `[car_loan_calculator]` anywhere in your content to display the calculator.