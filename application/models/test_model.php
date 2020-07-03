<?php 
class Test_model extends CI_Model{


    function get_metadata($lo_id, $rep_id){
        $this->db->select('lo_xml_lom');
        $query = $this->db->get_where('lo', array('lo_id' => $lo_id, 'rep_id' => $rep_id));

        return $query->result_array();
    }

}