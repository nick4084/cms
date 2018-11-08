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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/google-map.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script src="/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/api.js"></script>


<script src="/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/api-manager.js"></script>
<script src="/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/dashboard-operator.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script></script>
<!-- selectively load script -->
<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-emergency-event/") === 0) ? "<script type=\"text/javascript\" src=\"/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/dashboard-emergency-event.js\"></script>": ""; ?>
<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-emergency-event-details/") === 0) ? "<script type=\"text/javascript\" src=\"/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/dashboard-emergency-event-detail.js\"></script>": ""; ?>
<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-emergency-event-details/") === 0) ? "<script type=\"text/javascript\" src=\"/cms/wordpress/wp-content/themes/twentyseventeen/assets/js/dashboard-update-event.js\"></script>": ""; ?>

<!-- only load this script for pages that require map -->
<?php echo ((strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-psi/") === 0) || (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-operator/") === 0) || (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/general-psi/") === 0) || (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/general-dengue/") === 0)) ? "<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyDm3wkIZ2fCbok3eNQ_W5IarDxRIb7vuF8&callback=myMap\"></script>": ""; ?>


</body>
</html>