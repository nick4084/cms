<?php 
    if(isset($_POST['submit']))
    {
        $u = $_POST['login_username'];
        $p = $_POST['login_password'];
        
        $conn = mysqli_connect("localhost", "root", "", "cms");
        
        
        $sql = "SELECT * FROM cms_user WHERE username='$u' and password='$p'  " ;
        $search_result = mysqli_query($conn , $sql);    // search table NOW!
        
        // Return the number of rows in search result
        $userfound = mysqli_num_rows($search_result);
        
        
        if($userfound >= 1)
        {
            // User record is found in the cms_user
            session_start();
            $_SESSION['MM_Username'] = $u;
			$url = get_site_url();
			$_SESSION['defaulturl'] = $url;
            header("Location:dashboard-psi");
        }
        else
        {
            // User record is NOT found in the cms_user
            //header("Location: ");
            $error = "Invalid username or password";
        }
    }
?>
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
		<form id = "login_form" style="display: inline-block;" action="#" method="post">
			<input placeholder="Username" style="width:300px;" type="text" id="login_username" name = "login_username" />
			</br><input placeholder="Password" style="width:300px;" type="password" id="login_password" name = "login_password" />
			<br/><input id="submit" value="Login" style="width:300px" name="submit" type="submit"/>
			<br/><p style="color:red;"><?php if(isset($error)) echo $error;?></p>
			</form>
		</div>
	</div>
</div><!-- #primary -->
<hr>
<?php get_footer();
