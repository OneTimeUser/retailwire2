<?php
include('../wp-blog-header.php');
include('simple_html_dom.php');
$home = get_bloginfo('url');
$img_path = $home . "/newsletter/images/";

//get the date
if (isset($_GET['date'])) {
	$date = strtotime($_GET['date']); //specified date, e.g. 2016-03-24
} else {
	$date = time();	//today	
}
$year = date('Y', $date);
$month = date('m', $date);
$day = date('d', $date);
$date_str = date('l, F j, Y', $date);

//build date query
$date_query = array(array(
	'year' => $year,
	'month' => $month,
	'day' => $day,
));

//get latest resource post with delivery_newsletter checked
$resources = get_posts(array(
	'post_type' => 'resources',
	'posts_per_page' => 1,
	'orderby' => 'date',
	'order' => 'desc',
	'meta_query' => array(array(
		'key' => 'delivery_newsletter',
		'value' => 1,
	)),
));

//get latest discussions posts
$discussions = get_posts(array(
	'post_type' => 'discussion',
	'posts_per_page' => 3,
	'orderby' => 'date',
	'order' => 'desc',
	'date_query' => $date_query,
));

//get latest retail news posts
$news = get_posts(array(
	'post_type' => 'post',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'desc',
	'date_query' => $date_query,
));

//get latest press releases
$press_releases = get_posts(array(
	'post_type' => 'press_releases',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'desc',
	'date_query' => $date_query,
));

//get ads from adrotate - parse HTML
$ad_group_html = adrotate_group(6);
$ad_group_html_parsed = str_get_html($ad_group_html);
$ads = array();
foreach($ad_group_html_parsed->find('a') as $element) {
       $ads[] = $element;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <title>RetailWire Daily Delivery Newsletter</title>

    <style type="text/css">
	body {
		margin: 0;
		padding: 0;
		font-family: Arial, Helvetica, sans-serif;
		-ms-text-size-adjust: 100%;
		-webkit-text-size-adjust: 100%;
	}

	table {
		border-spacing: 0;
	}

	table td {
		border-collapse: collapse;
	}

	.ExternalClass {
		width: 100%;
	}

	.ExternalClass,
	.ExternalClass p,
	.ExternalClass span,
	.ExternalClass font,
	.ExternalClass td,
	.ExternalClass div {
		line-height: 100%;
	}

	.ReadMsgBody {
		width: 100%;
		background-color: #ebebeb;
	}

	table {
		mso-table-lspace: 0pt;
		mso-table-rspace: 0pt;
	}

	.fullwidth-image img {
		width: 100% !important;
		height: auto !important;
	}

	img {
		-ms-interpolation-mode: bicubic;
	}

	.yshortcuts a {
		border-bottom: none !important;
	}

	.ios-footer a {
		color: #aaaaaa !important;
		text-decoration: underline;
	}

    @media screen and (max-width: 680px) {
		table[class="force-row"],
		table[class="container"] {
			width: 100% !important;
			max-width: 400px !important;
		}
		td[class*="mobile-hidden"],
		span[class*="mobile-hidden"],
		img[class*="mobile-hidden"] {
			display: none !important;
			width: 0 !important;
		}
		td[class*="mobile-padding"] {
			padding-left: 15px !important;
			padding-right: 15px !important;
		}
		td[class*="mobile-center"],
		div[class*="mobile-center"] {
			text-align: center;
		}
		td[class*="article-text"] {
			padding-top: 15px;
		}
    }
    </style>
</head>
<body style="margin:0; padding:0;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="0" align="center">
    <tr>
        <td align="center" valign="top" width="100%">

            <!-- main table -->
            <table height="100%" width="610" border="0" cellpadding="0" cellspacing="0" class="container">
				<tr>
					<td class="main">
						<div class=""><a href="<?php echo $home; ?>/"><img src="<?php echo $img_path; ?>logo.png" alt="RetailWire Daily Delivery Newsletter" border="0" width="214" height="59"></a></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="7"></div>
						<div class="" style="font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: #a09e9b;">Daily Delivery Newsletter</div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="22"></div>
						<div class="" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #a09e9b;"><?php echo $date_str; ?></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="28"></div>
						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="15"></div>
						<div class=""><img src="<?php echo $img_path; ?>featured-resource.png" alt="Featured Resource" border="0" width="135" height="24"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="12"></div>
						
						<?php
						foreach ($resources as $post) {
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
							$url = get_permalink($post->ID);
						?>
							<div class="article">
								<!--[if mso]>
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td width="52%" valign="top"><![endif]-->
								<table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="force-row">
									<tr>
										<td class="col article-image">
											<a href="<?php echo $url; ?>"><img src="<?php echo $image[0]; ?>" style="max-width: 100%; height: auto;" border="0"></a>
										</td>
									</tr>
								</table>
								<!--[if mso]></td>
								<td width="48%" valign="top"><![endif]-->
								<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" class="force-row">
									<tr>
										<td class="col article-text" style="font-family: Arial, Helvetica, sans-serif; font-size:15px; width:100%;">
											<div>
												<a href="<?php echo $url; ?>" style="font-family: Palatino Linotype, Times New Roman, serif; font-size: 23px; line-height: 26px; font-weight: bold; color: #509cd0; text-decoration: none;">
													<?php echo $post->post_title; ?>
												</a>
											</div>
											<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="7"></div>
											<div style="line-height: 20px;"><?php echo $post->post_excerpt; ?></div>
											<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="15"></div>
											<div><a href="<?php echo $url; ?>"><img src="<?php echo $img_path; ?>download.png" alt="Download" border="0" width="149" height="34"></a></div>
										</td>
									</tr>
								</table>
								<!--[if mso]></td></tr></table><![endif]-->
								<div style="clear: both;"></div>
							</div>
						<?php } ?>
						
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="16"></div>
						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="16"></div>
						
						<div class=""><img src="<?php echo $img_path; ?>todays-three-discussions.png" alt="Today's Three Discussions" border="0" width="177" height="24"></div>
						
						<?php
						foreach ($discussions as $post) {
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
							$url = get_permalink($post->ID);
							$feat_comm = get_field('feat_comm', $post->ID);
							$feat_brain = get_field('feat_brain', $post->ID);
							$twitter_link = 'http://twitter.com/?status=' . urlencode($post->post_title . ' ' . $url);
							$linkedin_link = 'http://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($url) . '&title=' . urlencode($post->post_title);
							$facebook_link = 'http://www.facebook.com/sharer.php?u=' . urlencode($url) . '&t=' . urlencode($post->post_title);
							
							$email_body = 'Check out this RetailWire discussion article:' . '%0A%0A' .
								$post->post_title .'%0A%0A' .
								'Click to read: ' . $url . '%0A%0A' .
								'LIKE WHAT YOU SEE ON RETAILWIRE? Subscribe to our newsletter for daily updates:' . '%0A' .
								$home . '/subscribe/';
							$email_link = 'mailto:?subject=' . htmlspecialchars('From RetailWire: ' . $post->post_title) . '&body=' . htmlspecialchars($email_body);
						?>
							<div class="article">
								<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="13"></div>
								<div style="font-family: Palatino Linotype, Times New Roman, serif; font-size: 26px; font-weight: bold;" class="">
									<a href="<?php echo $url; ?>" style="color: #000; text-decoration: none;">
										<?php echo $post->post_title; ?>
									</a>
								</div>
								<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="13"></div>
								<!--[if mso]>
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td width="52%" valign="top"><![endif]-->
								<table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="force-row">
									<tr>
										<td class="col article-image">
											<a href="<?php echo $url; ?>"><img src="<?php echo $image[0]; ?>" style="max-width: 100%; height: auto;" border="0"></a>
											<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="14"></div>
											<div class="social-icons" align="left" style="text-align: left;">
												<a href="<?php echo $twitter_link; ?>"><img src="<?php echo $img_path; ?>icon-twitter.png" alt="Twitter" border="0" width="26" height="24"></a><a href="<?php echo $linkedin_link; ?>"><img src="<?php echo $img_path; ?>icon-linkedin.png" alt="LinkedIn" border="0" width="27" height="24"></a><a href="<?php echo $facebook_link; ?>"><img src="<?php echo $img_path; ?>icon-facebook.png" alt="Facebook" border="0" width="27" height="24"></a><a href="<?php echo $email_link; ?>"><img src="<?php echo $img_path; ?>icon-email.png" alt="Email" border="0" width="26" height="24"></a>
											</div>
										</td>
									</tr>
								</table>
								<!--[if mso]></td>
								<td width="48%" valign="top"><![endif]-->
								<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" class="force-row">
									<tr>
										<td class="col article-text" style="font-family: Arial, Helvetica, sans-serif; font-size:15px; line-height: 20px; width:100%;">
											<?php if($feat_comm && $feat_brain): //show featured braintrust comment if it exists ?>
												<div><img src="<?php echo $img_path; ?>braintrust-comment.png" alt="Braintrust Comment" border="0" width="154" height="24"></div>
												<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="11"></div>
												<div>
													<?php echo $feat_comm; ?>
													<br><strong><?php echo $feat_brain['display_name']; ?></strong>
												</div>
											<?php else: //show excerpt ?>
												<div>
													<?php echo $post->post_excerpt; ?>
												</div>
											<?php endif; ?>
										</td>
									</tr>
								</table>
								<!--[if mso]></td></tr></table><![endif]-->
								<div style="clear: both;"></div>
								<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="22"></div>
							</div>
						<?php } ?>

						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="18"></div>

						<!--[if mso]>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="50%" valign="top"><![endif]-->
						<table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="force-row">
							<tr>
								<td class="col" style="width:100%;">
									<div>
										<?php echo $ads[0]; ?>
									</div>
									<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
								</td>
							</tr>
						</table>
						<!--[if mso]></td>
						<td width="50%" valign="top"><![endif]-->
						<table width="300" border="0" cellpadding="0" cellspacing="0" align="right" class="force-row">
							<tr>
								<td class="col" style="width:100%;">
									<div>
										<?php echo $ads[1]; ?>										
									</div>
									<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
								</td>
							</tr>
						</table>
						<!--[if mso]></td></tr></table><![endif]-->
						
						<div class=""><a href="<?php echo $home; ?>/sponsorship/" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; font-weight: bold; text-decoration: none; color: #509cd0;">&gt;&gt; LEARN ABOUT RETAILWIRE MARKETING AND ADVERTISING OPPORTUNITIES</a></div>
						
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
						
						<div class=""><img src="<?php echo $img_path; ?>retail-news-headlines.png" alt="Retail News Headlines" border="0" width="154" height="24"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
						
						<?php
						foreach ($news as $post) {
							$url = get_permalink($post->ID);
						?>
							<div class="headline">
								<a href="<?php echo $url; ?>" style="font-family: Palatino Linotype, Times New Roman, serif; font-size: 19px; line-height: 22px; font-weight: bold; text-decoration: none; color: #000000;">
									<?php echo $post->post_title; ?>
								</a>
								<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-decoration: none; color: #9e9b8c;"><?php echo get_field('news_source', $post->ID); ?></div>
							</div>
							<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
						<?php } ?>

						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
						<div class=""><img src="<?php echo $img_path; ?>press-releases.png" alt="Press Releases" border="0" width="106" height="24"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>

						<?php
						foreach ($press_releases as $post) {
							$url = get_field('pr_url', $post->ID);
						?>
							<div class="headline">
								<a href="<?php echo $url; ?>" style="font-family: Palatino Linotype, Times New Roman, serif; font-size: 15px; line-height: 19px; font-weight: bold; text-decoration: none; color: #000000;">
									<?php echo $post->post_title; ?>
								</a>
								<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-decoration: none; color: #9e9b8c;"><?php echo get_field('pr_source', $post->ID); ?></div>
							</div>
							<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="20"></div>
						<?php } ?>
						
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="12"></div>
						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="25"></div>
						
						<div style="font-family: Arial, Helvetica, sans-serif; font-size: 26px; color: #a09e9b;">RetailWire Quick Links:</div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="13"></div>
						<div style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; letter-spacing: -1px; color: #a09e9b;">
							<a href="<?php echo $home; ?>/" style="text-decoration: none; color: #a09e9b;">FRONT PAGE</a>
							&nbsp;|&nbsp;
							<a href="<?php echo $home; ?>/discussions/" style="text-decoration: none; color: #a09e9b;">DISCUSSIONS</a>
							&nbsp;|&nbsp;
							<a href="<?php echo $home; ?>/retail-new/" style="text-decoration: none; color: #a09e9b;">RETAIL NEWS</a>
							&nbsp;|&nbsp;
							<a href="<?php echo $home; ?>/resources/" style="text-decoration: none; color: #a09e9b;">RESOURCES</a>
							&nbsp;|&nbsp;
							<a href="<?php echo $home; ?>/braintrust/" style="text-decoration: none; color: #a09e9b;">BRAINTRUST</a>
							&nbsp;|&nbsp;
							<a href="<?php echo $home; ?>/sponsorship/" style="text-decoration: none; color: #a09e9b;">SPONSORSHIPS</a>
							&nbsp;|&nbsp;
							<a href="<?php echo $home; ?>/about-us/" style="text-decoration: none; color: #a09e9b;">ABOUT</a>
						</div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="32"></div>
						<div class="divider"><img src="<?php echo $img_path; ?>divider.gif" style="max-width: 100%; height: 1px;" border="0"></div>
						<div><img src="<?php echo $img_path; ?>blank.gif" style="display:block;" border="0" width="1" height="18"></div>
						
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #a09e9b; line-height: 18px;">
							You are receiving this email because you are registered with RetailWire to receive this mailing. To manage your subscription preferences, or to remove your email address from our list, please do not reply to this email since it will only delay your request. Instead, please use the link below.
						</p>

						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #a09e9b; line-height: 18px;">
							To unsubscribe, change your individual newsletter options or update your email information:<br>
							<strong>
								<a href="[[UnsubscribeLink]]" style="text-decoration: none; color: #a09e9b;">UNSUBSCRIBE</a>
								/
								<a href="[[ChangeAddressLink]]" style="text-decoration: none; color: #a09e9b;">CHANGE MY EMAIL ADDRESS</a>
							</strong>
						</p>
						
						<p style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #a09e9b; line-height: 18px;">
							RetailWire<br>
							PO Box 150546 <br>
							Brooklyn, NY 11215<br>
							UNITED STATES<br>
							<a href="mailto:info@retailwire.com" style="text-decoration: none; color: #a09e9b;">info@retailwire.com</a>
						</p>
						
						<br><br>
						
					</td><!-- end main -->
				</tr>
            </table>
        
        </td>
    </tr>
</table>

</body>
</html>
