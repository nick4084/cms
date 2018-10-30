<div>
    <ul>
      <li><a class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard/"))=== "dashboard/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard">PSI</a></li>
      <li><a class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-dengue/"))=== "dashboard-dengue/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-dengue">Dengue</a></li>
      <li><a class="<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-emergency") === 0) ? "active": ""; ?>" href="localhost/cms/wordpress/Dashboard-emergency-event">Emergency Events</a></li>
      	
	</ul>
</div>