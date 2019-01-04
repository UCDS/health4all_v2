// {column_name{preset}, data_point1, data_point2, data_point3, ...}
// {JSON format table_data}
function draw_table_independent_rows_columns(table_id, table_data) {
    let data_keys = Object.keys(table_data);    
    data_keys.forEach(function(key, index){ 
        let columns = table_data[key];
    });
    
    // column_headers, table_id
    // from column_headers make an array of headers, and value_keys
    let cells = table_data['column_headers'].split(',');
    let header = ' ';
    let rows = new Object();
    cells.forEach(function(cell, index){
        let header_val_key = cell.split(':');
        header +='<th>'+header_val_key[0]+'</th>';
        data_keys.forEach(function(key, index){
            let data_point = table_data[key][0];
            let value_key = header_val_key[1];
            if(typeof data_point == 'string')
                return;
            if(value_key in data_point){                        // Mapped Data to header keys
                rows[key]='<td>'+data_point[value_key]+'</td>';
            }            
        });
    });
    row_values = Object.values(rows);
  //  console.log(rows);
  //  console.log(header + '#'+table_id+'thead tr');
    // attach the table elements to the corresponding rows
    $('#'+table_id+' thead tr').append(header);
    // row header + column header mapping
    // row_routes
    let row='';
    console.log(table_data['row_routes']);
    let row_column_headers = table_data['row_routes'].split(';');
    row_column_headers.forEach(function(rch, index){
        let rch_split = rch.split(":");
        let row_header = rch_split[0];
        let row_values = rch_split[1].split(',');
        row += '<tr><td>'+row_header+'</td>';        
        row_values.forEach(function(row_value){
            row+=rows[row_value];
        });
        row+='</tr>';
    });
    $('#'+table_id+' tbody ').append(row);
}
// Assumptions
// table_id set in response
// column headers with value_key/value_keys mapping set in response, all present, and they are in sequence
//  format {column_header:field1, field2, ...; column_header2: field1, field2, ...}
// row_routes with value_key/value_keys mapping set in response, and they are in sequence with column headers<<optional>>
//  format {header_string:route1, route2, ...; row_header2: route1, route2, ...}
function build_table(table_data) {
    // Get all the value mappings from header
    // Build header sequence
    let header_data = table_data['column_headers'];
    let header_value_pairs = header_data.split(';');
    let header_name = new Array();
    let value_key_seq = new Array();
    header_value_pairs.forEach(function(hvp, index){
        let temp = hvp.split(':');
        header_name.push(temp[0]);
        value_key_seq.push(temp[1]);
    });
    // Build rows if row_routes exist
    let rows = '';
    if('row_routes' in table_data) {   // Combine results from multiple routes into one row
        let row_routes = table_data['row_routes'];
        row_routes.forEach(function(header){
            let temp = header.split(';');
            rows+= '<tr><td>'+temp[0]+'</td>';
            let routes = temp[1].split(',');
            value_key_seq.forEach(function(val_key){    // Header columns
                let keys = val_key.split(',');
                keys.foreach(function(key){
                    if(routes.indexOf(key)>=0){
                        let values = Object.values(table_data[key]);
                        rows+='<td>';
                        values.forEach(function(value){
                            rows+=value;
                            console.log(value);
                        });
                        rows+='</td>';
                    }
                });
            });
            rows+='</tr>'
        });
    }
    // Iterate through the row value map
    //      if row headers set use it
    //      else each row is independent use only column header

}