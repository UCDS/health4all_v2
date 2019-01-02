<script type="text/javascript">
var table = {       // Row header, value, column header
    table_id: 'report_table',
    condition_met: {
        sbp: 'SBP >=',
        dbp: 'DBP >=',
        rbs: 'RBS >=',
        hb: 'HB <=',
        hba1c: 'HBA1C >=' 
    },
    condition_not_met: {
        nsbp: 'SBP >=',
        ndbp: 'DBP >=',
        nrbs: 'RBS >=',
        nhb: 'HB <=',
        nhba1c: 'HBA1C >=' 
    }
};
</script>
<form class="form-inline" id="form" action="<?php echo base_url().'generic_report/json_data'; ?>" method="post">
    <div class="form-group">
        <label for="from_date">From Date: </label>
        <input class="form-control" type="date" value='' name="from_date" id="" size="15" />
    </div>
    <div class="form-group">
        <label for="from_date">To Date: </label>
        <input class="form-control" type="date" value="" name="to_date" id="" size="15" />
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
        <input type="hidden" name="data_sources" class="form-control" id="data_sources" value="condition_met-sbp,dbp,rbs;condition_not_met-nsbp,ndbp,nrbs"><!-- hb,hba1c-->
    </div>
    <div class="form-group">
        <br>
        <button type="submit" id="submit" class="btn btn-default">Submit</button>
    </div>
</form>

<table class="table table-striped" id="report_table">
    <thead>
        
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
        
    </tfoot>
</table>