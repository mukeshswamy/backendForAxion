<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model {
    // CREATE
    public function saveProductAdded($data){
        $this->db->insert('users',$data);
        $userId = $this->db->insert_id();
        $response['status_code'] = 201;
        $response['response_message'] = "Product created with id: ".$userId;
        $res = $this->output->set_status_header(201)->set_content_type('application/json')->set_output(json_encode($response));
        return $res;
    }
    // READ
    public function showProducts(){
        $this->db->select();
        $query = $this->db->get('users');
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return $response= "No product Data Found";
    }
    // UPDATE
     public function productUpdated($id,$data){
        $this->db->select();
        $this->db->where('ID', $id);
        $this->db->update('users', $data);
        $response['status_code'] = 201;
        $response['response_message'] = "Product Updated with for id: ".$id;
        $res = $this->output->set_status_header(201)->set_content_type('application/json')->set_output(json_encode($response));
        return $res;
    }
    // GET_SINGLE_PRODUCT
    public function showSelectedProduct($id){
        $this->db->select();
        $this->db->from('users');
        $this->db->where('ID', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return $response= "No product Data Found";
    }
    // DELETE
    public function deleteSelectedProduct($id){
        $this->db->where('ID', $id);
        $this->db->delete('users');
        $response['status_code'] = 201;
        $response['response_message'] = "Product Deleted for id: ".$id;
        $res = $this->output->set_status_header(201)->set_content_type('application/json')->set_output(json_encode($response));
        return $res;
    }
}
