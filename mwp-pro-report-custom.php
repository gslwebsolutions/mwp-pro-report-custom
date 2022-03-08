<?php
/*
Template Name: MainWP Pro Report GSL Web Template
Description: Custom template for the MainWP Pro Reports extension
Version: 1.1
Author: GSL Web Solutions
Screenshot URI: ../wp-content/plugins/mainwp-pro-reports-extension/images/gslweb.jpg
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$config_tokens = array(
	0 => '[hide-if-empty]',
	1 => '', // show report data
	2 => '[hide-section-data]'
);

$default_config = array(
	'wp-update' => 0,
	'plugins-updates' => 0,
	'themes-updates' => 0,
	'lighthouse' => 0,
	'uptime' => 0,
	'security' => 0,
	'backups' => 0,
	'ga' => 0,
	'matomo' => 0,
	'pagespeed' => 0,
	'maintenance' => 0,
	'woocommerce' => 0
);


$bg_color = $report->background_color;
$showhide_values = @json_decode($report->showhide_sections, 1);

if (!is_array($showhide_values))
	$showhide_values = array();

$showhide_values = array_merge($default_config, $showhide_values);

if ( !empty( $bg_color ) )
	$bg_color = 'background:' . $bg_color . ';';

$accent_color = $report->accent_color;
if ( !empty( $accent_color ) )
	$accent_color = 'color:' . $accent_color . ';';

$accent_background = $report->accent_color;
if ( !empty( $accent_background ) )
	$accent_background = 'background:' . $accent_background . ';';

$text_color = $report->text_color;
if ( !empty( $text_color ) )
	$text_color = 'color:' . $text_color . ';';

$heading = $report->heading;
$intro = $report->intro;
$intro = nl2br($intro); // to fix

$outro = $report->outro;
$outro = nl2br($outro); // to fix

?>
<html>
	<head>
		<style type="text/css">
		@page { margin:0px; }
	 .page-break { page-break-after: always; }
		body {
			<?php echo esc_html( $bg_color ); ?>
			<?php echo esc_html( $text_color ); ?>
			font-size: 13px;
			font-family: 'Montserrat', sans-serif;
		}

		a {
			<?php echo esc_html( $accent_color ); ?>
			text-decoration: none;
		}

		p {
			font-family: 'Montserrat', sans-serif;
			line-height:1.5;
		}

		table {
			border:0px;
			width:100%;
		}

		table th {
			padding: 10px;
			<?php echo esc_html( $accent_background ); ?>
			color: #fff;
		}

		table td {
			padding:10px;
			background: #fafafa;
			border-bottom: 1px solid #eee;
			font-family: 'Montserrat', sans-serif;
		}

		table tr:nth-child(even) td {
			background: #fff;
		}

		table.left-th tr td:nth-of-type(2) {
			text-align: right;
		}

		h1 {
			color:#ffffff;
			font-weight:500;
			font-family: 'Montserrat', sans-serif;
			font-size:33px;
			text-align:right;
			text-transform:uppercase;
			line-height:1.2;
		}

		h2 {
			<?php echo esc_html( $accent_color ); ?>
			font-weight:500;
			font-family: 'Montserrat', sans-serif;
			font-size:28px;
			margin-bottom: 45px;
			text-align:center;
			text-transform:uppercase;
		}

		#ga-chart img {
			width: 100%;
		}

		header {
			padding: 0px;
			text-align: right;
		}
		
		.report-section {
			margin-top:60px;
		}
		
		footer {
			text-align: center; 
			font-size: 80%; 
			background: #3F3F3F; 
			color: #d7d7d7;
			position:absolute;
			bottom:0;
			left:0;
			display:block;
			width:100%;
		}
		
		.rp {
			display:none;
			width:0;
			height:0;
		}
		
		.section-backup tr.rp {
			display:table-row;
			width:auto;
			height:auto;
		}
		
		.section-backup td.rp {
			display:table-cell;
			width:auto;
			height:auto;
		}
		
		
		</style>
	</head>
	<body>
		<header>
			<img src="[header.image.url]" style="width:100%;"/>
			<div style="margin-top:-110px;margin-bottom:50px;padding-right:60px;color:#ffffff;">
				<h1 style="margin-bottom:0;"><?php echo esc_html( $heading ); ?></h1>
				<p style="font-size:16px;"><strong>[report.daterange]</strong></p>
			</div>
		</header>
		<main>
			<div style="margin:0;">
				<div style="padding:0px;">
					<div style="padding:0 60px;">
						<p><?php echo MainWP_Pro_Reports_Utility::esc_content( $intro ); ?></p>
					</div>
				</div>

				<div class="report-section" style="padding:0px;">
					<div style="padding:0 60px;">
						<h2>Overview</h2>
						<table cellspacing="0" class="left-th">
							<thead>
								<tr>
									<th><?php echo __( 'General Information', 'mainwp-pro-reports-extension' ); ?></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr><td><?php echo __( 'Website', 'mainwp-pro-reports-extension' ); ?></td><td><a href="[client.site.url]" target="_blank">[client.site.url]</a></td></tr>
								<tr><td><?php echo __( 'WordPress Version', 'mainwp-pro-reports-extension' ); ?></td><td>[client.site.version]</td></tr>
								<tr><td><?php echo __( 'Active Theme', 'mainwp-pro-reports-extension' ); ?></td><td>[client.site.theme]</td></tr>
								<tr><td><?php echo __( 'PHP Version', 'mainwp-pro-reports-extension' ); ?></td><td>[client.site.php]</td></tr>
								<tr><td><?php echo __( 'MySQL Version', 'mainwp-pro-reports-extension' ); ?></td><td style="padding:10px;">[client.site.mysql]</td></tr>
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['uptime']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Website Uptime', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.alltimeuptimeratio]</td></tr>
								[/remove-if-empty]
								[/config-section-data]
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['security']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Security Scans', 'mainwp-pro-reports-extension' ); ?></td><td>[sucuri.checks.count]</td></tr>
								[/remove-if-empty]
								[/config-section-data]
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['plugins-updates']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Plugins Updated', 'mainwp-pro-reports-extension' ); ?></td><td>[plugin.updated.count]</td></tr>
								[/remove-if-empty]
								[/config-section-data]
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['themes-updates']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Themes Updated', 'mainwp-pro-reports-extension' ); ?></td><td>[theme.updated.count]</td></tr>
								[/remove-if-empty]
								[/config-section-data]
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['backups']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Backups Created', 'mainwp-pro-reports-extension' ); ?></td><td>[backup.created.count]</td></tr>
								[/remove-if-empty]
								[/config-section-data]
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['maintenance']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Database Optimizations', 'mainwp-pro-reports-extension' ); ?></td><td>[maintenance.process.count]</td></tr>
								[/remove-if-empty]
								[/config-section-data]
								[config-section-data]
								<?php echo $config_tokens[$showhide_values['pagespeed']]; ?>
								[remove-if-empty]
								<tr><td><?php echo __( 'Average Pagespeed', 'mainwp-pro-reports-extension' ); ?></td><td>[pagespeed.average.desktop] / 100</td></tr>
								[/remove-if-empty]
								[/config-section-data]
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="page-break"></div>
				
				<!-- Performance Data -->
				
				<?php if ( is_plugin_active( 'mainwp-lighthouse-extension/mainwp-lighthouse-extension.php') ) : ?>
				[config-section-data]
				<?php echo $config_tokens[$showhide_values['lighthouse']]; ?>
				
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Performance', 'mainwp-pro-reports-extension' ); ?></h2>
						<?php  do_action( 'mainwp_pro_reports_before_lighthouse' ); ?>
							<table cellspacing="0" class="left-th">
								<thead>
									<tr>
										<th></th>
										<th style="text-align:center;"><?php echo __( 'Desktop', 'mainwp-pro-reports-extension' ); ?></th>
										<th style="text-align:center;"><?php echo __( 'Mobile', 'mainwp-pro-reports-extension' ); ?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo __( 'Last Check', 'mainwp-pro-reports-extension' ); ?></td>
										<td style="text-align:center;">[lighthouse.lastcheck.desktop]</td>
										<td style="text-align:center;">[lighthouse.lastcheck.mobile]</td>
									</tr>
									<tr>
										<td><?php echo __( 'Performance', 'mainwp-pro-reports-extension' ); ?></td>
										<td style="text-align:center;">[lighthouse.performance.desktop]/100</td>
										<td style="text-align:center;">[lighthouse.performance.mobile]/100</td>
									</tr>
									<tr>
										<td><?php echo __( 'Accessibility', 'mainwp-pro-reports-extension' ); ?></td>
										<td style="text-align:center;">[lighthouse.accessibility.desktop]/100</td>
										<td style="text-align:center;">[lighthouse.accessibility.mobile]/100</td>
									</tr>
									<tr>
										<td><?php echo __( 'SEO', 'mainwp-pro-reports-extension' ); ?></td>
										<td style="text-align:center;">[lighthouse.seo.desktop]/100</td>
										<td style="text-align:center;">[lighthouse.seo.mobile]/100</td>
									</tr>
									<tr>
										<td><?php echo __( 'Best Practices', 'mainwp-pro-reports-extension' ); ?></td>
										<td style="text-align:center;">[lighthouse.bestpractices.desktop]/100</td>
										<td style="text-align:center;">[lighthouse.bestpractices.mobile]/100</td>
									</tr>
								</tbody>
							</table>
						<?php do_action( 'mainwp_pro_reports_after_lighthouse' ); ?>
					</div>
				</div>
				[/config-section-data]
				<?php endif; ?>
				<!-- End Performance Data -->
				
				<div class="page-break"></div>
				
				<!-- Uptime Data -->
				<?php if ( is_plugin_active( 'advanced-uptime-monitor-extension/advanced-uptime-monitor-extension.php') ) : ?>
				[config-section-data]
				<?php echo $config_tokens[$showhide_values['uptime']]; ?>
				
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Uptime Monitoring', 'mainwp-pro-reports-extension' ); ?></h2>
						<?php do_action( 'mainwp_pro_reports_before_uptime' ); ?>
							<table cellspacing="0" class="left-th">
								<thead>
									<tr>
										<th><?php echo __( 'Monitoring Period', 'mainwp-pro-reports-extension' ); ?></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr><td><?php echo __( 'Overall', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.alltimeuptimeratio]</td></tr>
									<tr><td><?php echo __( 'Last 7 Days', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.uptime7]</td></tr>
									<tr><td><?php echo __( 'Last 15 Days', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.uptime15]</td></tr>
									<tr><td><?php echo __( 'Last 30 Days', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.uptime30]</td></tr>
									<tr><td><?php echo __( 'Last 45 Days', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.uptime45]</td></tr>
									<tr><td><?php echo __( 'Last 60 Days', 'mainwp-pro-reports-extension' ); ?></td><td>[aum.uptime60]</td></tr>
								</tbody>
							</table>
						<?php do_action( 'mainwp_pro_reports_after_uptime' ); ?>
					</div>
				</div>
				[/config-section-data]
				<?php endif; ?>
				<!-- End Uptime Data -->

				<!-- Security Scans Data -->
				<?php if ( is_plugin_active( 'mainwp-sucuri-extension/mainwp-sucuri-extension.php') ) : ?>
				[config-section-data]
				<?php echo $config_tokens[$showhide_values['security']]; ?>
				<div class="page-break"></div>
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Security', 'mainwp-pro-reports-extension' ); ?></h2>
						<?php do_action( 'mainwp_pro_reports_before_sucuri' ); ?>
						<table cellspacing="0">
							<thead>
								<tr>
									<th><?php echo __( 'Scanned on', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Status', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Webtrust Status', 'mainwp-pro-reports-extension' ); ?></th>
								</tr>
							</thead>
							<tbody>
								[section.sucuri.checks]
								<tr>
									<td>[sucuri.check.date]</td>
									<td>[sucuri.check.status]</td>
									<td>[sucuri.check.webtrust]</td>
								</tr>
								[/section.sucuri.checks]
							</tbody>
						</table>
						<?php do_action( 'mainwp_pro_reports_after_sucuri' ); ?>
					</div>
				</div>
				[/config-section-data]
				<?php endif; ?>
				<!-- End Security Scans Data -->

				<!-- Updates Data -->

				<?php do_action( 'mainwp_pro_reports_before_updates' ); ?>

				[config-section-data]
				<?php echo $config_tokens[$showhide_values['wp-update']]; ?>
				<div class="page-break"></div>
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'WordPress Updates', 'mainwp-pro-reports-extension' ); ?></h2>
						<table cellspacing="0">
							<thead>
								<tr>
									<th><?php echo __( 'Updated on', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Old Version', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'New Version', 'mainwp-pro-reports-extension' ); ?></th>
								</tr>
							</thead>
							<tbody>
								[section.wordpress.updated]
								<tr>
									<td>[wordpress.updated.date]</td>
									<td><span style="font-weight:bold;<?php echo esc_html( $accent_color ); ?>">[wordpress.old.version]</span></td>
									<td><span style="font-weight:bold;<?php echo esc_html( $accent_color ); ?>">[wordpress.current.version]</span></td>
								</tr>
								[/section.wordpress.updated]
							</tbody>
						</table>
					</div>
				</div>
				[/config-section-data]

				[config-section-data]
				<?php echo $config_tokens[$showhide_values['plugins-updates']]; ?>
				
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Plugins Updates', 'mainwp-pro-reports-extension' ); ?></h2>
						<table cellspacing="0">
							<thead>
								<tr>
									<th><?php echo __( 'Updated on', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Plugin', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Version', 'mainwp-pro-reports-extension' ); ?></th>
								</tr>
							</thead>
							<tbody>
								[section.plugins.updated]
								<tr>
									<td>[plugin.updated.date]</td>
									<td><span style="font-weight:bold;<?php echo esc_html($accent_color); ?>">[plugin.name]</span></td>
									<td>From [plugin.old.version] to <span style="font-weight:bold;<?php echo esc_html($accent_color); ?>">[plugin.current.version]</span></td><!-- plugin -->
								</tr>
								[/section.plugins.updated]
							</tbody>
						</table>
					</div>
				</div>
				[/config-section-data]

				[config-section-data]
				<?php echo $config_tokens[$showhide_values['themes-updates']]; ?>
				
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Themes Updates', 'mainwp-pro-reports-extension' ); ?></h2>
						<table cellspacing="0">
							<thead>
								<tr>
									<th><?php echo __( 'Updated on', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Theme', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Version', 'mainwp-pro-reports-extension' ); ?></th>
								</tr>
							</thead>
							<tbody>
								[section.themes.updated]
								<tr>
									<td>[theme.updated.date] </td>
									<td><span style="font-weight:bold;<?php echo esc_html( $accent_color ); ?>">[theme.name]</span></td>
									<td>From [theme.old.version] to <span style="font-weight:bold;<?php echo esc_html( $accent_color ); ?>">[theme.current.version]</span></td>
								</tr>
								[/section.themes.updated]
							</tbody>
						</table>
					</div>
				</div>
				[/config-section-data]

				<?php do_action( 'mainwp_pro_reports_after_updates' ); ?>

				<!-- End Updates Data -->

				<!-- Backups Data -->
				<?php if ( is_plugin_active( 'mainwp-backwpup-extension/mainwp-backwpup-extension.php' )
							|| is_plugin_active( 'mainwp-backupwordpress-extension/mainwp-backupwordpress-extension.php' )
							|| is_plugin_active( 'mainwp-buddy-extension/mainwp-buddy-extension.php' )
							|| is_plugin_active( 'mainwp-updraftplus-extension/mainwp-updraftplus-extension.php' )
							|| is_plugin_active( 'mainwp-time-capsule-extension/mainwp-time-capsule-extension.php' )
				) : ?>
				[config-section-data]
				<?php echo $config_tokens[$showhide_values['backups']]; ?>
				<div class="page-break"></div>
				<div class="section-backup report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Backups', 'mainwp-pro-reports-extension' ); ?></h2>
						<?php do_action( 'mainwp_pro_reports_before_backups' ); ?>
						<table cellspacing="0">
							<thead>
								<tr>
									<th style="width:50%;"><?php echo __( 'Date Range', 'mainwp-pro-reports-extension' ); ?></th>
									<th style="width:50%;"><?php echo __( 'Number of Backups', 'mainwp-pro-reports-extension' ); ?></th>
								</tr>
							</thead>
							<tbody>
								[section.backups.created][backup.created.date][/section.backups.created]
								
							</tbody>
						</table>
						<?php do_action( 'mainwp_pro_reports_after_backups' ); ?>
					</div>
				</div>
								<?php /*<tr>
									<td>[report.daterange]</td>
									<td>[backup.created.count]</td>
								</tr> */ ?>
				[/config-section-data]
				<?php endif; ?>
				<!-- End Backups Data -->

				<!-- Google Analytics Data -->
				<?php if ( is_plugin_active( 'mainwp-google-analytics-extension/mainwp-google-analytics-extension.php' ) ) : ?>
				[config-section-data]
				<?php echo $config_tokens[$showhide_values['ga']]; ?>
				[config-section-extra max-empty="7" /]
				<div class="page-break"></div>
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Analytics', 'mainwp-pro-reports-extension' ); ?></h2>
						<?php do_action( 'mainwp_pro_reports_before_ga' ); ?>
						<div style="margin: 30px 0;" id="ga-chart">[ga.visits.chart]</div>
						<table class="left-th" cellspacing="0">
							<thead>
								<tr>
									<th><?php echo __( 'Analytics Data', 'mainwp-pro-reports-extension' ); ?></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr><td><?php echo __( 'Website Visits', 'mainwp-pro-reports-extension' ); ?></td><td>[ga.visits]</td></tr>
								<tr><td><?php echo __( 'Page Views', 'mainwp-pro-reports-extension' ); ?></td><td>[ga.pageviews]</td></tr>
								<tr><td><?php echo __( 'Page Visits', 'mainwp-pro-reports-extension' ); ?></td><td>[ga.pages.visit]</td></tr>
								<tr><td><?php echo __( 'Bounce Rate', 'mainwp-pro-reports-extension' ); ?></td><td>[ga.bounce.rate]</td></tr>
								<tr><td><?php echo __( 'Average Time', 'mainwp-pro-reports-extension' ); ?></td><td>[ga.avg.time]</td></tr>
								<tr><td><?php echo __( 'New Visits', 'mainwp-pro-reports-extension' ); ?></td><td style="padding:10px;">[ga.new.visits]</td></tr>
							</tbody>
						</table>
						<?php do_action( 'mainwp_pro_reports_after_ga' ); ?>
					</div>
				</div>
				[/config-section-data]
				<?php endif; ?>
				<!-- End Google Analytics Data -->

				<!-- Maintenance Data -->
				<?php if ( is_plugin_active( 'mainwp-maintenance-extension/mainwp-maintenance-extension.php') ) : ?>
				[config-section-data]
				<?php echo $config_tokens[$showhide_values['maintenance']]; ?>
				<div class="page-break"></div>
				<div class="report-section" style="padding:0;">
					<div style="padding:0 60px;">
						<h2><?php echo __( 'Maintenance', 'mainwp-pro-reports-extension' ); ?></h2>
						<?php do_action( 'mainwp_pro_reports_before_maintenance' ); ?>
						<table cellspacing="0">
							<thead>
								<tr>
									<th><?php echo __( 'Date', 'mainwp-pro-reports-extension' ); ?></th>
									<th><?php echo __( 'Details', 'mainwp-pro-reports-extension' ); ?></th>
								</tr>
							</thead>
							<tbody>
								[section.maintenance.process]
								<tr>
									<td>[maintenance.process.date]</td>
									<td>[maintenance.process.details]</td>
								</tr>
								[/section.maintenance.process]
							</tbody>
						</table>
						<?php do_action( 'mainwp_pro_reports_after_maintenance' ); ?>
					</div>
				</div>
				[/config-section-data]
				<?php endif; ?>
				<!-- End Maintenance Data -->

				
				<div style="padding:0;">
					<div style="padding:0 60px;">
						<p><?php echo MainWP_Pro_Reports_Utility::esc_content( $outro ); ?></p>
					</div>
				</div>
				
			</div>
		</main>
		<footer>
			<div style="padding:30px;">
				<p><a style="color: #d7d7d7;" href="https://gslwebsolutions.com/">GSL Web Solutions</a> • <a style="color: #d7d7d7;" href="mailto:gerson@gslwebsolutions.com">gerson@gslwebsolutions.com</a>
				<br />
				<small>Prefer not to receive these reports? Let me know and I will disable them.</small></p>
			</div>
		</footer>
	</body>
</html>
