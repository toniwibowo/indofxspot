<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends MX_Controller {

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

 
  
  function register()
  {
    $data['errorMsg'] = '';
    $data['username'] = "";
    $data['password'] = "";
    $data['nama'] = "";
    $data['nama_sekolah'] = "";
    $data['telp_sekolah'] = "";
    $data['alamat_sekolah'] = "";
    $data['phone'] = "";
    $data['email'] = "";
    $data['password'] = "";
    $data['cap_img'] = $this -> _make_captcha();
    $data['cap_msg'] = "";
    if(!empty($_SESSION['username'])){
      echo "<script language='javascript'>alert('You have logged in');</script>";
      redirect('home');
      exit;
    }
    $this->load->view('registration-guru',$data);
  }
  
  function doRegister()
  {
    $file_dir = "memberfile/";
    //$username = $this->input->post('username',TRUE);
    $password         = $this->input->post('password',TRUE);
    $nama             = $this->input->post('nama',TRUE);
    $nama_sekolah     = $this->input->post('nama_sekolah',TRUE);
    $alamat_sekolah   = $this->input->post('alamat_sekolah',TRUE);
    $telp_sekolah     = $this->input->post('telp_sekolah',TRUE);
    $email            = $this->input->post('email',TRUE);
    $phone            = $this->input->post('phone',TRUE);
    $register_date    = date('Y-m-d');
   
    $qcek = $this->db->query("select * from guru where email = '$email'");
    if($qcek->num_rows() > 0){
    $data['errorMsg'] = 'This e-mail has been used for other Account';
     $data['username'] = "";
    $data['password'] = "";
    $data['nama'] = "";
    $data['nama_sekolah'] = "";
    $data['telp_sekolah'] = "";
    $data['alamat_sekolah'] = "";
    $data['phone'] = "";
    $data['email'] = "";
    $data['password'] = "";
    $data['cap_img'] = $this -> _make_captcha();
    $data['cap_msg'] = "";
      $this->load->view('registration-guru',$data);
    }
    else{
      $phone =  $phone;
      $hp = '';
      $in = $this->db->query("insert into guru(register_date,name,nama_sekolah,telp_sekolah,email,alamat_sekolah,phone,password) values(now(),'$nama','$nama_sekolah','$telp_sekolah','$email','$alamat_sekolah','$phone','$password')");
      
      if($in)
      {
        // $qP = $this->db->query("select * from province where province_id = '$province_id'");
        // $rP = $qP->row_array();
        // $qC = $this->db->query("select * from city where city_id = '$city_id'");
        // $rC = $qC->row_array();
        $comments = "Registration GURU Csr <br>";
        //$comments .= "Username : " . $username . "<br>";
        $comments .= "Nama : " . $nama . "<br>";
        $comments .= "Nama Sekolah : " . $nama_sekolah . "<br>";
        $comments .= "telp_sekolah : " . $telp_sekolah . "<br>";
        $comments .= "Phone : " . $phone . "<br>";
        $comments .= "Email : " . $email . "<br>";
        $comments .= "Phone : " . $phone . "<br>";
        
    
              $this->load->library('PHPMailerAutoload');
    
              $mail = new phpmailer();
              # Principal settings
              
              $mail->IsSMTP();
              $mail->Host     = "localhost";
              $mail->SMTPAuth = true;     // turn on SMTP authentication
             $mail->Username = "admin@indocalendar.com";  // SMTP username
        $mail->Password = "sketsa88"; // SMTP password
              
              $mail->From     = 'noreply@sketsaphotography.com';
              $mail->FromName = 'Registration Guru';
              $mail->AddAddress("yudi@sketsa.net","Yudi");
              $mail->AddBCC('hey_abud@yahoo.com');
            //  $mail->AddAddress("oxrabbitparty@gmail.comr","oxrabbitparty");
              
              $mail->IsHTML(true); // send as HTML
              # Embed images
              //$mail->AddEmbeddedImage('img/mailings/logo.gif', "logo_header");
              
              $mail->Subject = 'Guru Registration';
              //$mail->Body = $this->load->view('email/mailing_view','',TRUE);
              $mail->Body       = $comments;
              //$mail->AltBody = "This is the text-only body";
              
              $mail->Send();
              
        echo "<script language='javascript'>alert('Register Succeed');</script>";
        ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('home'); ?>'><?php
        exit;
      }
    }
  }
  
  function cekUsername($username)
  {
    $string = substr($username,0,5);
    if($string == "admin")
    {
      ?>
      <div style="color:#FF0000; ">Username Invalid</div>
      <?php
    }
    else
    {
      $user = $this->db->query("select username from member where username = '$username'");
      if($user->num_rows() == 1)
      {
        ?>
        <div style="color:#FF0000; ">Unavailable</div>
        <?php
      }
      else
      {
        ?>
        <div style="color:#339900; ">Available (Tersedia)</div>
        <?php
      }
    }
  }
  
  function login($direct = FALSE)
  {
    if(isset($_SESSION['username']) && $_SESSION['username'] != ""){
    if($direct == 'account'){
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url("member"); ?>'><?php
      exit;
    }elseif($direct == 'order'){
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url("member/orderhistory"); ?>'><?php
      exit;
    }
  }
    $data['direct'] = "";
    if($direct){
    $data['direct'] = $direct;
  }
    $this->load->view('login',$data);
  }
  
  function doLogin()
  {
    $username = trim($this->input->post('username',TRUE));
    $password = $this->input->post('password',TRUE);
    $cek = $this->db->query("select * from guru where email = '$username' and password = '$password'");
    $rCek = $cek->row_array();
    if($cek->num_rows() == 1)
    {
      $_SESSION['username'] = $rCek['email'];
      $_SESSION['name'] = $rCek['name'];
      $_SESSION['email'] = $rCek['email'];
      $_SESSION['mem_id'] = $rCek['guru_id'];
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
      ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('member/login'); ?>'><?php
    }
  }
  
  function logout()
  {
    
    
    session_destroy();
    ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('home'); ?>'><?php
  }
  
  function profile()
  {
                if(empty($_SESSION['email'])){
      session_destroy();
      echo "<script language='javascript'>alert('Please Login!');</script>";
   redirect('home');
      
    }
    $mem_id = $_SESSION['mem_id'];
    $data['query'] = $this->db->query("select * from guru where guru_id = '$mem_id'");

    $this->load->view('profile-guru',$data);
  }
  


  function updateprofile()
  {

      $username =  $_SESSION['username'];

     $cekQUery = $this->db->query("select * from guru where email = '$username' ");

     $cek = $cekQUery->row_array();

    // print_r($cek);
      $data['errorMsg'] = '';
    //$data['username'] = $row[''];
    $data['password'] = "";
    $data['nama'] = $cek['name'];
    $data['nama_sekolah'] = $cek['nama_sekolah'];
    $data['telp_sekolah'] = $cek['telp_sekolah'];
    $data['alamat_sekolah'] = $cek['alamat_sekolah'];
    $data['phone'] = $cek['phone'];
    $data['email'] = $cek['email'];
    $data['password'] = "";
    $data['cap_img'] = $this -> _make_captcha();
    $data['cap_msg'] = "";
    
    $this->load->view('update-profile-guru',$data);


  }


  function doUpdateProfile()
  {
    //print_r($_POST);
   $name             = $this->input->post('nama',TRUE);
    $nama_sekolah     = $this->input->post('nama_sekolah',TRUE);
    $alamat_sekolah   = $this->input->post('alamat_sekolah',TRUE);
    $telp_sekolah     = $this->input->post('telp_sekolah',TRUE);
    $email            = $this->input->post('email',TRUE);
    $phone            = $this->input->post('phone',TRUE);
    $password        = $this->input->post('password',TRUE);
    if($password !='')
    {

      $data = array (
            'name' => $name,
            'nama_sekolah'  => $nama_sekolah,
            'alamat_sekolah'=> $alamat_sekolah,
            'phone' =>$phone,
            'email' => $email,
            'password'=>$password
        );

    }else
    {

      $data = array (
            'name' => $name,
            'nama_sekolah'  => $nama_sekolah,
            'alamat_sekolah'=> $alamat_sekolah,
            'phone' =>$phone,
            'email' => $email
        );

    }
     



        $this->db->where('guru_id', $_SESSION['mem_id']);
        $this->db->update('guru', $data);
    
    echo "<script language='javascript'>alert('Update Success!');</script>";
      
            redirect('guru/profile');
      exit;

  }

  
  
  function forgot()
  {
    $this->load->view('forgot-guru');
  }
  
  function doForgot()
  {
    $email = $this->input->post('email',TRUE);
    $cek = $this->db->query("select * from guru where email = '$email' limit 1");
    if($cek->num_rows() == 0)
    {
      echo "<script language='javascript'>alert('Sorry," . $email . " not registered in our database');</script>";
      
      redirect('guru/forgot');
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
              
              $mail->Subject = 'Forgot Password CSR Guru';
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

  public function test()
  {
    echo date('d-m-y');
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


    function events()
    {

      $this->load->model("M_eventsguru");
       $data = $this->M_eventsguru->view();
      $this->load->view('events-guru',$data);
    }


    function eventsdetail($news_id,$link)
  {
    $data['query'] = $this->db->query("select * from events where events_id = '$news_id'");
    //$data['query2'] =$this->db->query("select * from imagenews where news_id = '$news_id'");
//$this->session->set_flashdata('sukses', '');
     
    //echo 'te4';
    $this->load->view('events-guru-detail',$data);
  }


  function absensi($event_id=0,$title)
  {

    $data = array();
    $data['event_id'] = $event_id;
    $data['title'] = $title;
     $this->load->view('absensi-form',$data);

  }


  function doAbsensi()
  {
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $event_id = $_POST['event_id'];
    $guru_id =  $_SESSION['mem_id'];
    $nama_guru = $_POST['nama'];
    $title = $_POST['title'];

    $cek = $this->db->query("select * from guru where phone= '$no_hp' and email = '$email'" );

    if($cek->num_rows()>0)
    {
      //insert ke guru_absensi
      date_default_timezone_set('Asia/Jakarta');
      $data = array(
                  'events_id' => $event_id ,
                  'guru_id' => $guru_id ,
                  'nama_guru' =>$nama_guru,
                  'date' =>gmdate('Y-m-d H:i:s',time()+60*60*7)
          );


      $this->db->insert('guru_absensi', $data);

      $this->session->set_flashdata('sukses', 'Terima kasih anda Berhasil melakukan absensi');
      redirect('guru/eventsdetail/'.$event_id.'/'.$title);

    }else{
      $this->session->set_flashdata('sukses', 'Anda belum terdaftar!! Atau No Hp salah');
      redirect('guru/eventsdetail/'.$event_id.'/'.$title);
    }

  }
  
}
?>