<?php
/**
 * The template for displaying the dashboard footer
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">

				
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/google-map.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- selectively load script -->
<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-emergency-event/"))=== "dashboard-emergency-event/") ? "<script type=\"text/javascript\" src=\"/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/dashboard-emergency-event.js\"></script>": ""; ?>

<!-- only load this script for pages that require map -->
<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard/"))=== "dashboard/") ? "<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyD-zuqQ7eq8N1ero-yXHg587rX8m6FMHiU&callback=myMap\"></script>": ""; ?>

</body>
</html>