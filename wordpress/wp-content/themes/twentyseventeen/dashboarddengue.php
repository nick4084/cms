<?php /* Template Name: Dashboard - Dengue */ ?>
<?php include 'header-dashboard.php';?>
<?php include 'side-menu.php';?>

<iframe id="dengue-container" width="100%" height="520px" src="https://data.gov.sg/dataset/dengue-clusters/resource/ce15cf3c-702c-4573-96db-69c50e6cb7f8/view/7bb2a106-0e86-4f18-873b-726bb5b6f922" frameBorder="1"></iframe>


<div class="wrapper">
<button type="button" class="circle float-button" data-toggle="modal" data-target="#addCaseModal" style = "background-color: #00ff00;"><div class="fas fa-plus"><span class="name"></span></div></button>

</div>

<!-- Modal -->
  <div class="modal fade" id="addCaseModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Case</h4>
        </div>
        <div class="modal-body">
          <p>Create new case</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php include 'footer-dashboard.php';?>