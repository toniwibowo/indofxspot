<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contactus  extends MX_Controller {

	// Site
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


        $this->load->model("M_news");

        $this->load->helper('captcha');
    }

	function index()
	{
		$data['name'] = "";
		$data['address'] = "";
		$data['phone'] = "";
 		$data['email'] = "";
		$data['message'] = "";
		$data['cap_img'] = $this -> _make_captcha();
		$data['cap_msg'] = "";
    $this->load->view('include/header');
		$this->load->view('contactus',$data);
    $this->load->view('include/footer');
	}

	function send()
	{
		 $nama             = $this->input->post('nama',TRUE);
     $subject           = $this->input->post('subject',TRUE);
    // $budget          = $this->input->post('budget',TRUE);
    // $harapan_area        = $this->input->post('harapan_area',TRUE);
    // $nama_apartemen        = $this->input->post('nama_apartemen',TRUE);
    // $nama_perusahaan       = $this->input->post('nama_perusahaan',TRUE);
    $email            = $this->input->post('email',TRUE);
    // $jadwal_showing      = $this->input->post('jadwal_showing',TRUE);
    // $jadwal_movin        = $this->input->post('jadwal_movin',TRUE);
    // $perkiraan_include_pajak = $this->input->post('perkiraan_include_pajak',TRUE);
    // $alamat_kantor       = $this->input->post('alamat_kantor',TRUE);
    // $keinginan_lain        = $this->input->post('keinginan_lain',TRUE);
    $comment          = $this->input->post('message',TRUE);
		$captcha = $this->input->post('captcha',TRUE);
		if ( $this -> _check_capthca($captcha) )
		{
			

			  $data = array(
                  'nama' => $nama,
                  'subject' => $subject,
                  
                  'email' => $email,
                  
                  'comment' => $comment,

      );

      $insert = $this->db->insert('contact', $data);


			if($insert)
			{
				$captcha_result = 'Contact Us Indosan';
				    $text = "Name : " . $nama . "<br>";
          $text .= "Subject : " . $subject . "<br>";
          $text .= "E-mail : " . $email . "<br>";
          //$text .= "Nama Perusahaan : " . $nama_perusahaan . "<br>";
          $text .= "Comment :  <br>";
          $text .= $comment;

				$this->load->library('PHPMailerAutoload');

				$mail = new phpmailer();
				# Principal settings

 $mail->SMTPOptions = array(
          'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          )
          );
				
				$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = "mail.indosan.com";
$mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = "admin@indosan.com";  // SMTP username
        $mail->Password = "f;iMyuVRb}&g"; //
$mail->SMTPSecure = 'none'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to
$mail->SMTPAutoTLS = false;
//$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)

				$mail->From     = $email;
				$mail->FromName = $nama;
				//$mail->AddAddress("lix_factor@yahoo.com","Felix Wijoyo");
				//$mail->AddAddress("lady_belle@ymail.com","Emmy");
				$mail->AddAddress("yudi@sketsa.net","Yudi");
				$mail->AddBCC("hey_abud@yahoo.com","Arief");

				$mail->IsHTML(true); // send as HTML
				# Embed images
				//$mail->AddEmbeddedImage('img/mailings/logo.gif', "logo_header");

				$mail->Subject = 'Contact to INDOSAN';
				//$mail->Body = $this->load->view('email/mailing_view','',TRUE);
				$mail->Body       = $text;
				//$mail->AltBody = "This is the text-only body";

				if(!$mail->Send())
				{
					echo "Message was not sent <br>";
					echo "Mailer Error: " . $mail->ErrorInfo;
					exit;
				}
				else {
					echo "<script language='javascript'>alert('Thank you for your attention');</script>";
					?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('contactus'); ?>'><?php
				}
			}
		}
		else
		{
			$captcha_result = 'Security Code Invalid';
		}
	  $data['name'] = $nama;
      //$data['phone'] = $phone;
      $data['email'] = $email;
      $data['subject'] = $subject;
      $data['comment'] = $comment;
      $data['captcha'] = $comment;
      $data['cap_img'] = $this -> _make_captcha();
      $data['cap_msg'] = $captcha_result;;
       $this->load->view('include/header');
		$this->load->view('contactus',$data);
		$this->load->view('include/footer');
	}

	function _make_captcha()
	  {
	    //$this -> load -> plugin( 'captcha' );
	    $vals = array(
	      'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
	      'img_url' => base_url() . 'captcha/', // URL for captcha img
	      'img_width' => 160, // width
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
}
?>
