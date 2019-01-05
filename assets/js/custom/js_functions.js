function build_table(table_data) {
    console.log(table_data);
    let table_id = $('#table_id').text();
    $('#'+table_id+' thead tr').remove();
    $('#'+table_id+' tbody tr').remove();
    let route_headers = new Object();
    let query_headers = new Array();
    let column_count = 0;
    let query_count = 0;
    let seqenced_rows = new Object();
    let rows_string = '';
    let row_query_strings = $('#row_query_strings').text();
    let column_query_strings = $('#column_query_strings').text();
    let header_querys = column_query_strings.split(';');
    header_querys.forEach(function(query){
        let header = query.split(':');
        route_headers[header[0]] = header[1].split('~');
    });
    
    if(row_query_strings != '') {
        let rows_str = row_query_strings.split(';');       
        rows_str.forEach(function(row_str, index){
            seqenced_rows[row_str] = new Array();
            for(let route in route_headers){
                seqenced_rows[row_str].push(route_headers[route][index]);
            }
        });
    } else {
        // Todo
    }
    
    for(let row in seqenced_rows) {
        rows_string += "<tr><td>"+row.split('#')[1]+"</td>";
        seqenced_rows[row].forEach(function(row){   // Getting value for each row
            let data_points;      // Data point object
            if(row in table_data){
                data_points = table_data[row];
            } else {
                data_points = new Array();
            }        
            data_points.forEach(function(data_point){
                for(let column in data_point){
                    rows_string += "<td>"+data_point[column];   // Built cell for each data point
                }
                rows_string += "</td>";
            });
        });
        rows_string += "</tr>";
    }
    let header_string = '<tr><th>#</th>';
    for(let header in route_headers){
        let heading = header.split('#')[1];
        header_string += '<th>'+heading+'</th>';
    }
    header_string +='</tr>';

    $('#'+table_id+' thead ').append(header_string);
    $('#'+table_id+' tbody ').append(rows_string);
    
    console.log(rows_string);
}