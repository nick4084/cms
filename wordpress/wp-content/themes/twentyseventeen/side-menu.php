<div>
    <ul>
		<li><a id="psi" style="display: block" class="<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-psi/") === 0) ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-psi">PSI</a></li>
		<li><a id="dengue" style="display: block" class="<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-dengue/") === 0) ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-dengue">Dengue</a></li>
		<!-- only load the following for call_operator -->
		<li><a style="display: <?php echo ($_SESSION["role"]==="Call_Operator") ? "block": "none"; ?>" class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-operator/"))=== "dashboard-operator/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-operator">Cases</a></li>
		<!-- only load the following for roles manager and officer -->
		<li><a style="display: <?php echo ($_SESSION["role"]==="Call_Operator") ? "none": "block"; ?>" class="<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-emergency") === 0) ? "active": ""; ?>" href="localhost/cms/wordpress/Dashboard-emergency-event">Emergency Events</a></li>
		<li><a style="display: <?php echo ($_SESSION["role"]==="Call_Operator") ? "none": "block"; ?>" id="update-event"  class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-update-event/"))=== "dashboard-update-event/") ? "active": ""; ?>" href="localhost/cms/wordpress/Dashboard-update-event">Update Events</a></li>
	</ul>
</div>
