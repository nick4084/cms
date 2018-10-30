<?php
/**
 * The header for dashboard
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="/cms/wordpress/wp-content/themes/twentyseventeen/assets/css/dashboard-template.css">
<link rel="stylesheet" href="/cms/wordpress/wp-content/themes/twentyseventeen/assets/css/style.css">
<link rel="stylesheet" href="/cms/wordpress/wp-content/themes/twentyseventeen/assets/css/table-style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header role="banner">
		<div class="nav-bar-top">
		<img class = "dashboard-logo" src="http://localhost/cms/wordpress/wp-content/uploads/2018/10/cms_logo.jpg" alt="" />
		<?php 
		session_start();
		$url = $_SESSION['defaulturl'];?>
		<a id="logout" href="<?php echo $url;?>/logout.php" style="float:right; padding:20px;display:block;">Logout</a>
		</div>
	</header><!-- #masthead -->

	<div class="site-content-contain">
		<div id="content" class="site-content">

