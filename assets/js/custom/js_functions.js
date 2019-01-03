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
            if(value_key in data_point){
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
    // row_headers
    let row='';
    console.log(table_data['row_headers']);
    let row_column_headers = table_data['row_headers'].split(';');
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