<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ukm extends MX_Controller {

    private $title;
    private $logo;

    // Template
    private $admin_template;
    private $front_template;
    private $auth_template;
    private $youtubeanak_template;

    // Auth view
    private $login_view;
    private $register_view;
    private $forgot_password_view;
    private $reset_password_view;

    // Default page
    private $default_page;
    private $login_success;

    public function __construct()
    {
        parent::__construct();
        $this->config->load('sketsanet');
        $this->load->library('output_view');
        $this->load->library('pagination');


        // Site
        $site = $this->config->item('site');
        $this->title = $site['title'];
        $this->logo = $site['logo'];

        // Template
        $template = $this->config->item('template');
        $this->admin_template = $template['backend_template'];
        $this->front_template = $template['front_template'];
        $this->auth_template = $template['auth_template'];
        $this->plugkreasi_home_template = $template['plugkreasi_home_template'];

        // Auth view
        $view = $this->config->item('view');
        $this->login_view = $view['login'];
        $this->register_view = $view['register'];
        $this->forgot_password_view = $view['forgot_password'];
        $this->reset_password_view = $view['reset_password'];

        // Default page
        $route = $this->config->item('route');
        $this->default_page = $route['default_page'];
        $this->login_success = $route['login_success'];

        $this->load->helper('captcha');
        
    }


  function index()
  {
    $this->load->view('index-member');
  }

 
  
  
  
  function login($direct = FALSE)
  {
    if(isset($_SESSION['username_ukm']) && $_SESSION['username_ukm'] != ""){
    if($direct == 'account'){
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url("ukm"); ?>'><?php
      exit;
    }elseif($direct == 'order'){
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url("ukm/profile"); ?>'><?php
      exit;
    }
  }
    $data['direct'] = "";
    if($direct){
    $data['direct'] = $direct;
  }
    $this->load->view('login-ukm',$data);
  }
  
  function doLogin()
  {
    $username = trim($this->input->post('username',TRUE));
    $password = $this->input->post('password',TRUE);
    $cek = $this->db->query("select * from profile_ukm where email = '$username' and password = '$password'");
    $rCek = $cek->row_array();
    if($cek->num_rows() == 1)
    {
      $_SESSION['username_ukm'] = $rCek['email'];
      $_SESSION['name_ukm'] = $rCek['nama_usaha'];
      $_SESSION['email_ukm'] = $rCek['email'];
      $_SESSION['mem_id_ukm'] = $rCek['profile_ukm_id'];
    if(isset($_POST['redirect'])){
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url($_POST['redirect']); ?>'><?php
    exit;
    }
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url("home"); ?>'><?php
    exit;
    }
    else
    {
      session_destroy();
      echo "<script language='javascript'>alert('Username or Password Invalid');</script>";
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('ukm/login'); ?>'><?php
    }
  }
  
  function logout()
  {
    
    
    session_destroy();
    ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('home'); ?>'><?php
  }
  
  function profile()
  {
                if(empty($_SESSION['email_ukm'])){
      session_destroy();
      echo "<script language='javascript'>alert('Please Login!');</script>";
      redirect('home');
    }
    $mem_id_ukm = $_SESSION['mem_id_ukm'];
    $data['query'] = $this->db->query("select * from profile_ukm where profile_ukm_id = '$mem_id_ukm'");

    $this->load->view('profile-ukm',$data);
  }
  

  function updateprofile()
  {

      if(empty($_SESSION['email_ukm'])){
      session_destroy();
      echo "<script language='javascript'>alert('Please Login!');</script>";
      redirect('home');
    }
    $mem_id_ukm = $_SESSION['mem_id_ukm'];
    $data['query'] = $this->db->query("select * from profile_ukm where profile_ukm_id = '$mem_id_ukm'");

    $this->load->view('profile-ukm-form',$data); 
  }


   function doUpdateProfile()
  {
    //print_r($_POST);
   $no_telp             = $this->input->post('no_telp',TRUE);
    $alamat_usaha     = $this->input->post('alamat_usaha',TRUE);
    $jenis_usaha     = $this->input->post('jenis_usaha',TRUE);
    

      $data = array (
            'no_telp' => $no_telp,
            
            'alamat_usaha'=> $alamat_usaha,
            'jenis_usaha'=> $jenis_usaha,
        );

    
     



        $this->db->where('profile_ukm_id',$_SESSION['mem_id_ukm']);
        $this->db->update('profile_ukm', $data);
    
    echo "<script language='javascript'>alert('Update Success!');</script>";
      redirect('ukm/profile');

  }

  function doProfile()
  {
    $file_dir = "memberfile/";
    $mem_id = $this->input->post('mmid',TRUE);
    $name = $this->input->post('name',TRUE);
  $lastname = $this->input->post('lastname',TRUE);
    $address = $this->input->post('address',TRUE);
    $phone = $this->input->post('phone',TRUE);
    $hp = $this->input->post('hp',TRUE);
  $province_id = $this->input->post('province',TRUE);
  $city_id = $this->input->post('city',TRUE);
  $zip_code = $this->input->post('zip_code',TRUE);
    $qcek = $this->db->query("update member set name = '$name', lastname = '$lastname', address = '$address', phone = '$phone', hp = '$hp', province_id = '$province_id', city_id = '$city_id', zip_code = '$zip_code' where member_id = '$mem_id'");
    if($qcek){
      echo "<script language='javascript'>alert('Edit Account Succeed');</script>";
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('member/profile'); ?>'><?php
      exit;  
    }
  }
  
  function forgot()
  {
    $this->load->view('forgot-ukm');
  }
  
  function doForgot()
  {
    $email = $this->input->post('email',TRUE);
    $cek = $this->db->query("select * from profile_ukm where email = '$email' limit 1");
    if($cek->num_rows() == 0)
    {
      echo "<script language='javascript'>alert('Sorry," . $email . " not registered in our database');</script>";
      
      redirect('ukm/forgot');
    }
    else
    {
    $row = $cek->row_array();
   $comments = "This is your password in CSR FIF GROUP <br>";
    //$comments .= "Username : " . $row['username'] . "<br>";
    $comments .= "Password : " . $row['password'];
    
    
              $this->load->plugin('phpmailer');
    
              $mail = new phpmailer();
              # Principal settings
              
              $mail->IsSMTP();
              $mail->Host     = "localhost";
              $mail->SMTPAuth = true;     // turn on SMTP authentication
             $mail->Username = "email@indocalendar.com";  // SMTP username
                     $mail->Password = "sketsa88"; // SMTP password
              
              $mail->From     = 'noreply@csr-fifgroup.com';
              $mail->FromName = 'System Admin CSR';
              $mail->AddAddress($email,$email); //You can add more emails
              
              $mail->IsHTML(true); // send as HTML
              # Embed images
              //$mail->AddEmbeddedImage('img/mailings/logo.gif', "logo_header");
              
              $mail->Subject = 'Forgot Password CSR UKM';
              //$mail->Body = $this->load->view('email/mailing_view','',TRUE);
              $mail->Body       = $comments;
              //$mail->AltBody = "This is the text-only body";
              
              if(!$mail->Send())
              {
              echo "Message was not sent <br>";
              echo "Mailer Error: " . $mail->ErrorInfo;
              exit;
              }
              else {
                echo "<script language='javascript'>alert('Your password has been sent to your email');</script>";
                redirect('home');
              }
    }
    
  }

  


  function _make_captcha()
    {
      //$this -> load -> plugin( 'captcha' );
      $vals = array(
        'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
        'img_url' => base_url() . 'captcha/', // URL for captcha img
        'img_width' => 100, // width
        'img_height' => 30, // height
        'font_path'     => './system/fonts/comic.ttf',
        'expiration' => 3600 ,
        );
      // Create captcha
      $cap = create_captcha( $vals );
      // Write to DB
      if ( $cap ) {
        $data = array(
          //'captcha_id' => '',
          'captcha_time' => $cap['time'],
          'ip_address' => $this -> input -> ip_address(),
          'word' => $cap['word'] ,
          );
        $query = $this -> db -> insert_string( 'captcha', $data );
        $this -> db -> query( $query );
      }else {
        return "Umm captcha not work" ;
      }
      return $cap['image'] ;
    }
   
    function _check_capthca()
    {
      // Delete old data ( 2hours)
      $expiration = time()-3600 ;
      $sql = " DELETE FROM captcha WHERE captcha_time < ? ";
      $binds = array($expiration);
      $query = $this->db->query($sql, $binds);
   
      //checking input
      $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
      $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
      $query = $this->db->query($sql, $binds);
      $row = $query->row();
   
    if ( $row -> count > 0 )
      {
        return true;
      }
      return false;
   
    }


    function produk()
    {

      if(empty($_SESSION['email_ukm'])){
      session_destroy();
      echo "<script language='javascript'>alert('Please Login!');</script>";
      redirect('home');
      exit;
    }


       $this->load->library('output_view');

        $this->load->library('Grocery_CRUD');
        $this->load->library('Grocery_CRUD_Multiuploader');
        //$crud = new grocery_CRUD();
        $crud = new Grocery_CRUD_Multiuploader(); 

        $crud->where('profile_ukm_id',$_SESSION['mem_id_ukm']);
        $crud->set_table('product_ukm');
        $crud->order_by('date_posting');
        $crud->set_subject('Produk');
        $crud->columns('profile_ukm_id','date_posting','category_product_id','name','image_small');
        $crud->fields('profile_ukm_id','date_posting','category_product_id','name','image_small','file_images');
        $crud->change_field_type('profile_ukm_id','invisible');

        $crud->callback_before_insert(array($this,'profile_ukm_product_callback'));
        

       $crud->set_field_upload('image_small');

       $crud->set_relation('category_product_id','category_produk_ukm','category_produk_ukm_name');


          //============TAMBAHAN MULTIUPLOAD =================================================

         // Field upload


            $config = array(

        /* Destination directory */
        "path_to_directory"       =>'assets/uploads/files/',

        /* Allowed upload type */
        "allowed_types"           =>'gif|jpeg|jpg|png',

        /* Show allowed file types while editing ? */
        "show_allowed_types"      => true,
    
        /* No file text */
        "no_file_text"            =>'No Pictures',

        /* enable full path or not for anchor during list state */
        "enable_full_path"        => false,

        /* Download button will appear during read state */
        "enable_download_button"  => true,

        /* One can restrict this button for specific types...*/
        "download_allowed"        => 'jpg'      
     );


          
                $crud->new_multi_upload('file_images',$config);
          



        //============END TAMBAHAN MULTIUPLOAD =================================================

  $data = (array) $crud->render();


        $this->load->view('produk',$data);    
  //print_r($data);



    }



   public function profile_ukm_product_callback($post_array,$primary_key)
    {
      $post_array['profile_ukm_id']  = $_SESSION['mem_id_ukm'];

      return $post_array;
    }





     function laporan()
    {

      if(empty($_SESSION['email_ukm'])){
      session_destroy();
      echo "<script language='javascript'>alert('Please Login!');</script>";
      redirect('home');
      exit;
    }


       $this->load->library('output_view');

        $this->load->library('Grocery_CRUD');
        $this->load->library('Grocery_CRUD_Multiuploader');
        //$crud = new grocery_CRUD();
        $crud = new Grocery_CRUD_Multiuploader(); 

        $crud->where('profile_ukm_id',$_SESSION['mem_id_ukm']);
        $crud->set_table('laporan_ukm');
        $crud->order_by('laporan_ukm_id');
        $crud->set_subject('Laporan');
        $crud->columns('laporan_bantuan','laporan_biaya_perbulan','laporan_penjualan','laporan_keuntungan');
        $crud->fields('profile_ukm_id','laporan_bantuan','laporan_biaya_perbulan','laporan_penjualan',
          'laporan_keuntungan');
        $crud->change_field_type('profile_ukm_id','invisible');

        $crud->callback_before_insert(array($this,'profile_ukm_product_callback'));
        

       //$crud->set_field_upload('image_small');

       //$crud->set_relation('category_product_id','category_produk_ukm','category_produk_ukm_name');


          



        //============END TAMBAHAN MULTIUPLOAD =================================================

  $data = (array) $crud->render();


        $this->load->view('produk',$data);    
  //print_r($data);



    }



  
}
?>