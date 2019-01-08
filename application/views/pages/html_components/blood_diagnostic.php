<script type="text/javascript">
    
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
    <!--    <input type="hidden" name="query_strings" id="query_strings" 
        value="sbp,dbp,rbs,hb,hba1c,nsbp,ndbp,nrbs,nhb,nhba1c"><!-- rbs,hb,hba1c,nsbp,ndbp,nrbs-->
    </div>
    <div class="form-group">
        <br>
        <button type="submit" id="submit" class="btn btn-default">Submit</button>
    </div>
</form>
<!--<input type="hidden" name="column_query_strings" id="column_query_strings" value="SBP >=:sbp,nsbp;DBP >=:dbp,ndbp;RBS >=:rbs,nrbs;HB <=:hb,nhb;HBA1C >=:hba1c,nhba1c">-->
<p hidden id="column_query_strings">1#SBP >=:sbp~nsbp;2#DBP >=:dbp~ndbp;3#RBS >=:rbs~nrbs;4#HB <=:hb~nhb;5#HBA1C >=:hba1c~nhba1c</p>
<p hidden id="row_query_strings" >1#Condition met;2#Condition not met</p>
<p hidden id="original_row_query_strings" >1#Condition met;2#Condition not met</p>
<p hidden id="table_id">report_table</p>
<p hidden id="display_route_header">true</p>
<p hidden id="display_query_header">false</p>
<p hidden id="display_column_name">false</p>
<p hidden id="combine_columns">true</p>
<p hidden id="query_strings">sbp,dbp,rbs,hb,hba1c,nsbp,ndbp,nrbs,nhb,nhba1c</p>
<p hidden id="original_table_id">report_table</p>
<table class="table table-striped" id="report_table">
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

<table class="table table-striped" id="detailed_table" hidden>
    <thead>
        <tr>
            <th>#Detailed</th>
        </tr>
    </thead>
    <tbody><!-- tr td -->
    
    </tbody>
    <tfoot><!-- tr td -->
        
    </tfoot>
</table>