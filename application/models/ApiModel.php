<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {
    public function saveProductAdded($data){
        $this->db->insert('products',$data);
        $userId = $this->db->insert_id();
        $response['status_code'] = 201;
        $response['response_message'] = "Product created with id: ".$userId;
        $res = $this->output->set_status_header(201)->set_content_type('application/json')->set_output(json_encode($response));
        return $res;
    }
    public function showProducts(){
        $this->db->select();
        $query = $this->db->get('products');
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return $response= "No product Data Found";
    }
}
