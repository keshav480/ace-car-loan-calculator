== Ace Car Loan Calculator ===

Contributors: acewebx
Tags: car loan, calculator, emi, loan, finance
Requires at least: 5.0
Tested up to: 6.9
Version: 1.0.0
Stable Tag: 1.0.0
Donate link: https://www.paypal.me/acewebx
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple and professional Car Loan Calculator for WordPress with shortcode support and admin settings.

== External Services ==

This plugin does not connect to any external services. Chart.js library is bundled locally with the plugin.

**Chart Library:** Chart.js (MIT Licensed)

Chart.js is bundled locally with the plugin for rendering the loan breakdown doughnut chart. No external resources or services are used.

**License:** Chart.js is provided under the MIT License, which is compatible with GPLv2+.
- Chart.js GitHub: https://github.com/chartjs/Chart.js
- Chart.js License: https://github.com/chartjs/Chart.js/blob/master/LICENSE.md

== Description ==

The Ace Car Loan Calculator plugin allows users to calculate their monthly car loan payments, interest, and amortization schedules directly on your WordPress site.  

It includes admin settings to configure default values, toggle features like charts, schedules, and customize the UI.

**Features:**

- Frontend shortcode `[car_loan_calculator]`

- Customizable defaults: car price, loan term, interest rate

- Toggle display of Pie Chart, Interest Data, Amortization Schedule

- Customize button colors and tooltip styles

- Uses WordPress settings API (stored in `wp_options`)

== Installation ==

1. Upload the plugin ZIP via **Plugins → Add New → Upload Plugin**.

2. Activate the plugin.

3. Configure settings via **Admin → Car Loan Calculator**.

4. Add the shortcode `[car_loan_calculator]` to any page or post.

== Frequently Asked Questions ==

= How do I show the calculator? =

Use the shortcode `[car_loan_calculator]` anywhere in your content.

= Can I change the default values? =

Yes, go to **Settings → Car Loan Calculator** in the admin dashboard.

= Does it support multiple currencies? =

Yes, you can set a currency symbol (e.g. $, €, £, ₹) in the admin settings.

== Screenshots ==

1. Calculator frontend form

2. Admin settings page

== Changelog ==

= 1.0 =

* Initial release with shortcode and admin settings.

== Upgrade Notice ==

= 1.0 =

First stable release.