<script type="text/javascript">
    var draw_table = function(data) {
        draw_table_independent_rows_columns('report_table', data);
    }
</script>
<form class="form-inline" id="primary_filter" action="<?php echo base_url().'/generic_resport/json_data';?>" method="post">
    <div class="form-group">
        <label for="from_date">From Date: </label>
        <input class="form-control" type="date" value='' name="from_date" id="from_date" size="15" />
    </div>
    <div class="form-group">
        <label for="to_date">To Date: </label>
        <input class="form-control" type="date" value='' name="to_date" id="to_date" size="15" />
    </div>
    <div class="form-group">
        <label for="sbp">SBP: </label>
        <input maxlength="4" size="4" type="text" name="sbp" class="form-control" id="sbp" placeholder="SBP >=">
    </div>
    <div class="form-group">
        <label for="dbp">DBP: </label>
        <input maxlength="4" size="4" type="text" name="dbp" class="form-control" id="dbp" placeholder="DBP >=">
    </div>
    <div class="form-group">
        <label for="rbs">RBS: </label>
        <input maxlength="4" size="4" type="text" name="rbs" class="form-control" id="rbs" placeholder="RBS <=">
    </div>
    <div class="form-group">
        <label for="hb">HB: </label>
        <input maxlength="4" size="4" type="text" name="hb" class="form-control" id="hb" placeholder="HB >=">
    </div>
    <div class="form-group">
        <label for="dbp">HBA1C: </label>
        <input maxlength="4" size="4" type="text" name="hba1c" class="form-control" id="hba1c" placeholder="HBA1C >=">
        <input type="hidden" name="routes" id="routes" 
        value="sbp,dbp"><!-- rbs,hb,hba1c,nsbp,ndbp,nrbs-->
        <input type="hidden" name="column_headers" id="column_headers" value="SBP >=:sbp,nsbp;DBP >=:dbp,ndbp;RBS >=:rbs,nrbs;HB <=:hb,nhb;HBA1C >=:hba1c,nhba1c">
        <input type="hidden" name="row_routes" id="row_routes" value="Condition met:sbp,dbp,rbs,hb,hba1c;Condition not met:nsbp,ndbp,nrbs,nhb,nhba1c">
        <input type="hidden" name="table_id" id="table_id" value="report_table">
    </div>
    <div class="form-group">
        <br>
        <button type="submit" id="submit" class="btn btn-default">Submit</button>
    </div>
</form>

<table class="table table-striped" id="report_table" class="hidden">
    <thead>
        <tr>
            <th>#</th>
        </tr>
    </thead>
    <tbody><!-- tr td -->
    
    </tbody>
    <tfoot><!-- tr td -->
        
    </tfoot>
</table>