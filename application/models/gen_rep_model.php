<?php
class Gen_rep_Model extends CI_Model {
    private $routes = array(    //'sbp,dbp,rbs,hb,hba1c'
        'route_name'=>array(
            'filters'=>array(   // set or false

            ),
            'where'=>array(

            ),
            'join_sequence'=>array(

            ),
            'group_by'=>array(

            ),
            'having'=>array(

            )
        ),
        'sbp'=>array(
            'filters'=>array(   // set or false
                '>='=>array('sbp-patient_visit.sbp')
            ),
            'select'=>'COUNT(*) as sbp',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'dbp'=>array(
            'filters'=>array(   // set or false
                '>='=>array('dbp-patient_visit.dbp')
            ),
            'select'=>'COUNT(*) as dbp',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'rbs'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('rbs-test_result.test_result')
            ),
            'select'=>'COUNT(*) as rbs',
            'from'=>'patient_visit',
            'where'=>array(
                '='=>array('LIKE(rbs)-test_master.text_name')
            ),             // test_master.test_name = rbs, 
            'join_sequence'=>array(
                'patient_visit.visit_id=test_order.visit_id',
                'test_order.order_id=test.order_id',
                'test.test_master_id=test_master.test_master_id'
            ),     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false
        ),
        'hb'=>array(
            'filters'=>array(   // set or false

            ),
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'hba1c'=>array(
            'filters'=>array(   // set or false

            ),
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
    );
    
    function __construct() {
        parent::__construct();
    }

    function simple_join($route, $post_data) {
        // Failure condition
        if(!array_key_exists($route, $this->routes))
            return false;
        // Route extraction
        $select = $this->routes[$route]['select'] ? $this->routes[$route]['select'] : array();
        $from = $this->routes[$route]['from'] ? $this->routes[$route]['from'] : array();
        $filters = $this->routes[$route]['filters'] ? $this->routes[$route]['filters'] : array();
        $where = $this->routes[$route]['where'] ? $this->routes[$route]['where'] : array();
        $join_sequence = $this->routes[$route]['join_sequence'] ? $this->routes[$route]['join_sequence'] : array();
        $group_by = $this->routes[$route]['group_by'] ? $this->routes[$route]['group_by'] : array();
        $having = $this->routes[$route]['having'] ? $this->routes[$route]['having'] : array();
        
        $this->db->select($select);
        $this->db->from($from);
        // Filters{operator=>array(input_key-table_name.column_name)}
        foreach($filters as $op => $filters) {
            foreach($filters as $filter){
                $temp = explode('-', $filter);
                $column = '';
                $input = '';
                if(sizeof($temp)>1){
                    $input = $temp[0];
                    $column = $temp[1];
                } else {
                    $temp = explode('.', $filter);
                    $input = $temp[1];
                    $column = $filter;
                }
                if(array_key_exists($input, $post_data)) {
                    $value = $post_data[$input];
                    $this->db->where("$column ".$op, "$value");
                }
            }
        }
        // Default where condition // Date
        if(array_key_exists('from_date', $post_data) && array_key_exists('to_date', $post_data)){
            if($post_data['from_date']){
                $from_date = date("Y-m-d",strtotime($post_data['from_date']));
                $to_date = date("Y-m-d",strtotime($post_data['to_date']));
                $this->db->where('(patient_visit.admit_date BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
            }
        }
        else {
            $date = date("Y-m-d");
            $this->db->where('(patient_visit.admit_date BETWEEN "'.$date.'" AND "'.$date.'")');
        }

        // Where conditions{string}{(operator_value-table_name.column_name)}
        foreach($where as $op => $columns) {
            foreach($columns as $column){
                $temp = explode('-', $column);
                $this->db->where("$temp[1] ".$op, "$temp[0]");
            }
        }
        // Join conditions{join_from_table_name.column_name, join_to_table_name.column_name}
        foreach($join_sequence as $join) {
            $tables = explode('=', $join);
            $temp = explode('.', $tables[0]);
            $table_one = $temp[0];
            $this->db->join("$table_one[0]", "$join[1]=$join[2]", 'left');
        }
        // Group by conditions{table_name.column_name, table_name.column_name}{string}
        foreach($group_by as $group) {
            $this->db->group_by("$group");
        }
        // Having conditions{$op=>value-table_name.column_name}
        foreach($having as $op => $column) {
            $value = explode('-', $column);
            $value = $value[0];
            $this->db->having("$column $op $value");
        }
        // Execute query
        $query = $this->db->get();
        echo $this->db->last_query();
        $result = array();
        $result = $query->result();
        
        return $result;
    }
}