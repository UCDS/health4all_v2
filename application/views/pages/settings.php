  <div class="container">

      <?php echo form_open('user_panel/form_layout',array('role'=>'form')); ?>
			<div class="row">
				<div class="col-md-10">
				</div>
		<div class="col-sm-3 col-md-2 sidebar-left">
		<strong>Settings</strong>
          <ul class="nav nav-sidebar nav-stacked">
			
			<li class="nav-divider"></li>
			<li>Forms</li>
            <li> 
				<a href="<?php echo base_url()."user_panel/form_layout";?>">Create New</a>
			</li>
			<li class="disabled"><a>Edit</a>
            <ul>
				<li> 
				<a href="#">Out Patient Form</a>
				</li>
				<li> 
				<a href="#">In Patient Form</a>
				</li>
			</ul>
			</li>
		  </ul>
        </div>
		</div>
      </form>

    </div>