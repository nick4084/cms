<div id="primary" class="content-area" style="text-align: center; vertical-align: center; height: 100%;">
	<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div style="height: auto; min-height:100%">
	<p style="text-align: center; margin-top: 50px"><img class="alignnone wp-image-25" src="http://localhost/cms/wordpress/wp-content/uploads/2018/10/nea-logo-full-colour-300x120.jpg" alt="" width="500" height="200" /></p>
	<p style="text-align: center;"><strong style="font-size: 40px">CRISIS MANAGEMENT SYSTEM</strong></p>
	<p style="text-align: center;">Login page</p>
		<div id="login_holder" style="text-align:center;">
		<form id = "login_form" style="display: inline-block;">
			<input placeholder="Username" style="width:300px;" type="text" id="login_username" name = "login_username" />
			</br><input placeholder="Password" style="width:300px;" type="password" id="login_password" name = "login_password" />
			</br><a href="dashboard"><input value="Login" style="width:300px" type="button"/></a>
			</form>
		</div>
	</div>
</div><!-- #primary -->
<hr>
<?php get_footer();
