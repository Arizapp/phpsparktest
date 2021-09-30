<?php
/**
 * @var string                $meta_keywords
 * @var string                $meta_description
 * @var array                 $extra_tags
 * @var \App\Entities\SysPage $page
 */

if (isset($page))
{
	$identifier = current(explode('/', $page->uri));
	$meta_keywords = $page->meta_keywords;
	$meta_description = $page->meta_description;
	$title = $page->meta_description;
	$meta_og_title = $page->meta_og_title;
	$meta_og_description = $page->meta_og_description;
	$meta_og_image = $page->meta_og_image;
	$meta_twitter_title = $page->meta_twitter_title;
	$meta_twitter_description = $page->meta_twitter_description;
	$meta_twitter_image = $page->meta_twitter_image;
	$meta_twitter_site = $page->meta_twitter_site;
	$meta_twitter_creator = $page->meta_twitter_creator;
}
$favicon = sys_config()->favicon ? img_uploaded_url(sys_config()->favicon) : base_url('favicon.png');
$title = isset($title) ? (sys_config()->title . " | {$title}") : sys_config()->title;
$meta_keywords = $meta_keywords ?? sys_config()->meta_keywords;
$meta_description = str_replace(PHP_EOL, ' ', $meta_description ?? '') ?? '';
/* Facebook */
$meta_og_title = !empty($meta_og_title) ? $meta_og_title : sys_config()->meta_og_title;
$meta_og_title = !empty($meta_og_title) ? $meta_og_title : $title;
$meta_og_description = !empty($meta_og_description) ? $meta_og_description : sys_config()->meta_og_description;
$meta_og_description = !empty($meta_og_description) ? $meta_og_description : $meta_description;
$meta_og_image = !empty($meta_og_image) ? $meta_og_image : sys_config()->meta_og_image;
$meta_og_image = !empty($meta_og_image) ? $meta_og_image : $favicon;
$meta_og_type = $meta_og_type ?? 'website';
/* Twitter */
$meta_twitter_title = !empty($meta_twitter_title) ? $meta_twitter_title : sys_config()->meta_twitter_title;
$meta_twitter_title = !empty($meta_twitter_title) ? $meta_twitter_title : $title;
$meta_twitter_description = !empty($meta_twitter_description) ? $meta_twitter_description : sys_config()->meta_twitter_description;
$meta_twitter_description = !empty($meta_twitter_description) ? $meta_twitter_description : $meta_description;
$meta_twitter_image = !empty($meta_twitter_image) ? $meta_twitter_image : sys_config()->meta_twitter_image;
$meta_twitter_image = !empty($meta_twitter_image) ? $meta_twitter_image : $favicon;
$meta_twitter_site = !empty($meta_twitter_site) ? $meta_twitter_site : sys_config()->meta_twitter_site;
$meta_twitter_creator = !empty($meta_twitter_creator) ? $meta_twitter_creator : sys_config()->meta_twitter_creator;
/* Extra tags */
$extra_tags = $extra_tags ?? [];
?>
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?= csrf_meta() ?>
    <link rel="shortcut icon" type="image/png" href="<?= $favicon ?>"/>
	<?php if (!empty($meta_description)) echo "<meta name='description' content='{$meta_description}'>" . PHP_EOL; ?>
	<?php if (!empty($meta_keywords)) echo "<meta name='keywords' content='{$meta_keywords}'>" . PHP_EOL; ?>
    <meta property="og:title" content="<?= $meta_og_title ?>"/>
    <meta property="og:url" content="<?= current_url() ?>"/>
	<?php if (!empty($meta_description)) echo "<meta property='og:description' content='{$meta_og_description}' />" . PHP_EOL; ?>
    <meta property="og:image" content="<?= site_url("assets/img/uploads/{$meta_og_image}"); ?>"/>
    <meta property="og:type" content="<?= $meta_og_type ?>"/>
    <meta name="twitter:title" content="<?= $meta_twitter_title ?>">
	<?php if (!empty($meta_twitter_description)) echo "<meta property='twitter:description' content='{$meta_twitter_description}' />" . PHP_EOL; ?>
    <meta name="twitter:image" content="<?= site_url("assets/img/uploads/{$meta_twitter_image}"); ?>">
	<?php if (!empty($meta_twitter_site)) echo "<meta property='twitter:site' content='{$meta_twitter_site}' />" . PHP_EOL; ?>
	<?php if (!empty($meta_twitter_creator)) echo "<meta property='twitter:creator' content='{$meta_twitter_creator}' />" . PHP_EOL; ?>
	<?php
	vendor_js('jquery/jquery');
	vendor_js('bootstrap/bootstrap.bundle');
	vendor_js('jquery-mask-plugin/jquery.mask');
	vendor_js('owl-carousel/owl.carousel');
	vendor_css('owl-carousel/assets/owl.carousel');
	vendor_css('owl-carousel/assets/owl.theme.default');
	foreach ($extra_tags as $item) echo $item;
	js('activateMasks');
	css('main');
	?>
</head>