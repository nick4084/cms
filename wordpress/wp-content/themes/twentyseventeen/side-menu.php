<div>
    <ul>
      <li><a id="genPsi" style="display: block" class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("general-psi/"))=== "general-psi/") ? "active": ""; ?>" href="localhost/cms/wordpress/general-psi">PSI</a></li>
      <li><a id="genDengue" style="display: block" class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("general-dengue/"))=== "general-dengue/") ? "active": ""; ?>" href="localhost/cms/wordpress/general-dengue">Dengue</a></li>
      <li><a id="psi" style="display: none" class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-psi/"))=== "dashboard-psi/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-psi">PSI</a></li>
      <li><a id="dengue" style="display: none" class="<?php echo (substr($_SERVER['REQUEST_URI'], -strlen("dashboard-dengue/"))=== "dashboard-dengue/") ? "active": ""; ?>" href="localhost/cms/wordpress/dashboard-dengue">Dengue</a></li>
      <li><a class="<?php echo (strpos($_SERVER['REQUEST_URI'], "/cms/wordpress/dashboard-emergency") === 0) ? "active": ""; ?>" href="localhost/cms/wordpress/Dashboard-emergency-event">Emergency Events</a></li>
	</ul>
</div>
