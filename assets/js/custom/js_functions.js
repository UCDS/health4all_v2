function build_table(table_data) {
    let table_id = localStorage.getItem('table_id');
    let row_query_strings = localStorage.getItem('row_query_strings');
    let column_query_strings = localStorage.getItem('column_query_strings');
    
    $('#'+table_id+' thead tr').remove();
    $('#'+table_id+' tbody tr').remove();
    let route_headers = new Object();
    let query_headers = new Array();
    let column_count = 0;
    let query_count = 0;
    let seqenced_rows = new Object();
    let rows_string = '';
    if(column_query_strings!=''){
        let header_querys = column_query_strings.split(';');
        header_querys.forEach(function(query){
            let header = query.split(':');
            route_headers[header[0]] = header[1].split('~');
        });
    }
    
    if(row_query_strings != '') {
        let rows_str = row_query_strings.split(';');       
        rows_str.forEach(function(row_str, index){
            seqenced_rows[row_str] = new Array();
            for(let route in route_headers){
                seqenced_rows[row_str].push(route_headers[route][index]);
            }
        });
        for(let row in seqenced_rows) {
            rows_string += '<tr><td>'+row.split('#')[1]+'</td>';
            seqenced_rows[row].forEach(function(row){   // Getting value for each row
                let data_points;      // Data point object
                if(row in table_data){
                    data_points = table_data[row];
                } else {
                    data_points = new Array();
                }        
                data_points.forEach(function(data_point){
                    for(let column in data_point){
                        rows_string += "<td><a href='#"+row+'_detail'+"'>"+data_point[column]+'</a>';   // Built cell for each data point
                    }
                    rows_string += '</td>';
                });
            });
            rows_string += '</tr>';
        }
        let header_string = '<tr><th>#</th>';
        for(let header in route_headers){
            let heading = header.split('#')[1];
            header_string += '<th>'+heading+'</th>';
        }
        header_string +='</tr>';
    
        $('#'+table_id+' thead ').append(header_string);
        $('#'+table_id+' tbody ').append(rows_string);
    } else {
        console.log('In else');
        let query_string = Object.keys(table_data);
        // Getting headers and formatting headers
        query_string.forEach(function(query_result){
            let table = table_data[query_result];
            let table_headers = Object.keys(table[0]);
            let header_string = '<tr><th>#</th>';
            table_headers.forEach(function(header){
                header = header.replace('_', ' ');
                header = header.charAt(0).toUpperCase() + header.slice(1);
                header_string += '<th>'+header+'</th>';
            });
            header_string +='</tr>';
            $('#'+table_id+' thead ').append(header_string);
            let html_rows =  '<tr>';
            let index = 1;
            table.forEach(function(row){
                let columns = Object.values(row);
                html_rows += '<td>'+index+'&nbsp;</td>';
                columns.forEach(function(column){
                    html_rows += '<td>'+column+'</td>';
                });
                html_rows+= '</tr>'
                index++;
            });            
            $('#'+table_id+' tbody ').append(html_rows);
            
        });
    }
    
    localStorage.clear();
    set_localStorage();
}

function set_localStorage(){
    console.log('Called local store');
    localStorage.clear();
    localStorage.setItem("table_id", $('#table_id').text());
    localStorage.setItem('query_strings', $('#query_strings').text());
    localStorage.setItem("row_query_strings", $('#row_query_strings').text());
    localStorage.setItem("column_query_strings", $('#column_query_strings').text());
}