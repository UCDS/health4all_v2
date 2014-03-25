  <div class="container">

      <?php echo form_open('user_panel/op_layout',array('class'=>'form-custom','role'=>'form')); ?>
			<div class="row">
				<div class="col-md-9">
				<h4>Form</h4>
				</div>
		<div class="col-sm-3 col-md-3 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><label><input type="checkbox" value="1" id="patient_name" class="form-control checklist" />Patient name</label></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
        </div>
		</div>
      </form>

    </div>