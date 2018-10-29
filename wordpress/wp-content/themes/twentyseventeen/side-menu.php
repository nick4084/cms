<div>
    <ul>
      <li><a class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-psi/"))=== "dashboard-psi/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-psi">PSI</a></li>
      <li><a class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-dengue/"))=== "dashboard-dengue/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-dengue">Dengue</a></li>
      <li><a class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-emergency-event/"))=== "dashboard-emergency-event/") ? "active": ""; ?>" href="localhost/cms/wordpress/Dashboard-emergency-event">Emergency Events</a></li>
	</ul>
</div>
