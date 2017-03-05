<!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  <!-- Angular Material requires Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
<script src="<?php echo base_url();?>client_side_script/app/patient_update_app.js"></script>									<!-- Main app.js -->
<script src="<?php echo base_url();?>client_side_script/services/patient_update_services.js"></script>								<!-- Main services.js -->
<script src="<?php echo base_url();?>client_side_script/controllers/patient_update_controllers.js"></script>                                                   <!-- Main controllers.js -->
<style>
  .tabsdemoDynamicHeight md-content {
    background-color: transparent !important;
  }
  .tabsdemoDynamicHeight md-content md-tabs {
    background: #f6f6f6;
    border: 1px solid #e1e1e1;
  }
  .tabsdemoDynamicHeight md-content md-tabs md-tabs-wrapper {
    background: white;
  }
  .tabsdemoDynamicHeight md-content h1:first-child {
    margin-top: 0;
  }
</style>
<div ng-app="patientUpdateApp">
<div ng-cloak="" class="tabsdemoDynamicHeight" ng-controller="RouteController as routeController">
    <div>
        <md-content>
            <md-tab label="OBG"><a ng-href="#/visit_obg_details/{{ routeController.getPatientID() }}">OBG</a></md-tab>
            <md-tab label="Patient Info"></md-tab>
        </md-content>
        <a ng-href="#/" class="btn btn-info" role="button">Back</a>
        <ul class="nav nav-tabs">
            <li><a ng-href="#/patient_personal_information/{{ routeController.getPatientID() }}">Patient Info</a></li>
            <li><a ng-href="#/patient_childs_information/{{ routeController.getPatientID() }}">Visit Info</a></li>
            <li><a ng-href="#/visit_mlc_details/{{ routeController.getPatientID() }}">MLC Details</a></li>
            <li><a ng-href="#/visit_obg_details/{{ routeController.getPatientID() }}">OBG</a></li>
            <li><a ng-href="#/visit_clinical_information/{{ routeController.getPatientID() }}">Clinical</a></li>
            <li><a ng-href="#/visit_diagnostics/{{ routeController.getPatientID() }}">Diagnostics</a></li>
            <li><a ng-href="#/visit_procedures/{{ routeController.getPatientID() }}">Procedures</a></li>
            <li><a ng-href="#/visit_prescription/{{ routeController.getPatientID() }}">Prescription</a></li>
            <li><a ng-href="#/visit_discharge/{{ routeController.getPatientID() }}">Discharge</a></li>
        </ul>
    </div>
</div>
    <div ng-view></div>
</div>


