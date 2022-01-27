<?php

/**
 *
 */
class Product extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

     $this->load->model("M_product");
  }

  public function index(){

  	$data = $this->M_product->view();
  	$data['category'] = 'Index';
    $data['image_header'] ='';
    $data['image_header_en'] ='';
    $data['subcategory'] = '';
    $this->load->view('include/header');
    $this->load->view('product',$data);
    $this->load->view('include/footer');
  }

  function detail($id)
  {

    $data['query']= $this->db->query("select * from product where product_id = ".$id);

   $this->load->view('include/header');
    $this->load->view('product-detail',$data);
    $this->load->view('include/footer');
  }


  function category($category_id,$title)
  {

	  $data = $this->M_product->category($category_id,$title);
    $category = $this->db->query("select * from category_product where category_product_id = ".$category_id);
    $cat= $category->row_array();
    $data['category'] = $cat['category_product_name'];
    $data['image_header'] = $cat['image_small'];
    $data['image_header_en'] = $cat['image_small_en'];
    $data['subcategory'] = '';
	  $this->load->view('include/header',$data);
    $this->load->view('product',$data);
    $this->load->view('include/footer');
  }

function subcategory($category_id,$subcategory_id,$title)
  {

	  $data = $this->M_product->subcategory($category_id,$subcategory_id,$title);
    $category = $this->db->query("select * from category_product where category_product_id = ".$category_id);

    $cat= $category->row_array();


    $subcategory = $this->db->query("select * from subcategory2_product where subcategory_product_id = ".$subcategory_id);
    $subcategoryname = $this->db->query("select * from subcategory_product where subcategory_product_id = ".$subcategory_id);

    $data['image_header_en'] = '';

    $data['category'] = $cat['category_product_name'];
    $data['image_header'] = $cat['image_small'];
    $data['subcategory'] = $subcategory;
    $data['subcategory_name'] = $subcategoryname->row()->name;
	  $this->load->view('include/header', $data);
    $this->load->view('product',$data);
    $this->load->view('include/footer');

  }



   function subcategory2($category_id,$subcategory_id,$subcategory2_id,$title)
  {

  $data = $this->M_product->subcategory2($category_id,$subcategory_id,$subcategory2_id);
  $category = $this->db->query("select * from category_product where category_product_id = ".$category_id);
   $cat= $category->row_array();

    $data['category'] = $cat['category_product_name'];
    $this->load->view('include/header');
    $this->load->view('product',$data);
    $this->load->view('include/footer');

  }

}
