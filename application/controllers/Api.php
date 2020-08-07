<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct($config = 'rest')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('ApiModel');
    }
    // CREATE
    public function addProduct(){
        $this->form_validation->set_rules('productName', 'Product Name', 'required');
        $this->form_validation->set_rules('productPrice', 'Product Price', 'required');
        $this->form_validation->set_rules('productSKU', 'Product SKU', 'required');
        $this->form_validation->set_rules('productQuantity', 'Product Quantity', 'required');
        if($this->form_validation->run() == FALSE){
            $response = array();
            $response['status_code'] = 422;
            $response['reason'] = "Validation Failed";
            $response['validation_message'] = validation_errors();
            $result = $this->output->set_status_header(422)->set_content_type('application/json')->set_output(json_encode($response));
            return $result;
        }else{
            $data = array();
            $data['product_name'] = $this->input->post('productName',TRUE);
            $data['price'] = $this->input->post('productPrice',TRUE);
            $data['sku'] = $this->input->post('productSKU',TRUE);
            $data['quantity'] = $this->input->post('productQuantity',TRUE);
            $result = $this->ApiModel->saveProductAdded($data);
        }
    }
    // READ
    public function showTotalProducts()
    {
        $result = $this->ApiModel->showProducts();
        echo json_encode($result);  
    }
    // UPDATE
    public function updateProduct($id){
        $this->form_validation->set_rules('productName', 'Product Name', 'required');
        $this->form_validation->set_rules('productPrice', 'Product Price', 'required');
        $this->form_validation->set_rules('productSKU', 'Product SKU', 'required');
        $this->form_validation->set_rules('productQuantity', 'Product Quantity', 'required');
        if($this->form_validation->run() == FALSE){
            $response = array();
            $response['status_code'] = 422;
            $response['reason'] = "Validation Failed";
            $response['validation_message'] = validation_errors();
            $result = $this->output->set_status_header(422)->set_content_type('application/json')->set_output(json_encode($response));
            return $result;
        }else{
            $data = array();
            $data['product_name'] = $this->input->post('productName',TRUE);
            $data['price'] = $this->input->post('productPrice',TRUE);
            $data['sku'] = $this->input->post('productSKU',TRUE);
            $data['quantity'] = $this->input->post('productQuantity',TRUE);
            $result = $this->ApiModel->productUpdated($id,$data);
        }
    }
    // GET_SINGLE_PRODUCT
    public function showSingleProducts($id)
    {
        $result = $this->ApiModel->showSelectedProduct($id);
        echo json_encode($result);  
    }
    // DELETE
    public function deleteProduct($id){
        $result = $this->ApiModel->deleteSelectedProduct($id);
    }
}
