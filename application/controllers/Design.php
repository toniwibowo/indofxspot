<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * Name : Sketsa.cms base controller.
 *
 * @version 3.8.2
 *
 * @author : Arief Budiyono
 */
class Design extends MX_Controller
{


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
        $this->plugkreasi_home_template = $template['home'];

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


     /**
     * Default page.
     *
     * @return HTML
     **/
    public function index()
    {
      //print_r($this->session->all_userdata());

      $data['name'] = "";
    $data['email']  ='';
    $data['comment']= '';
    $data['captcha'] = "";
    $data['cap_img'] = $this -> _make_captcha();
    $data['cap_msg'] = "";
    //$this->load->view('contact-us',$data);
    //$this->session->set_userdata('site_lang', 'id');
    if(empty($this->session->userdata('site_lang')))
    {
      $this->session->set_userdata('site_lang', 'id');
    }
     // echo $this->session->userdata('site_lang');


    	//$data = array();
	     //$data['site_lang'] = !empty($this->session->userdata('site_lang'))?$this->session->userdata('site_lang'):'en';

       //echo $data['site_lang'] ;

		  //$this->output_view->set_wrapper('page', 'home_video', $data);
     	//$template = $this->plugkreasi_home_template;
      //$this->output_view->output($template);
      $this->load->view('design-frontend/home',$data);



    }



    function send(){

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('subject', 'Subject', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
    //$this->form_validation->set_rules('budget', 'Budget', 'required');
    // $this->form_validation->set_rules('jadwal_showing', 'Jadwal Showing', 'required');
    // $this->form_validation->set_rules('Jadwal Movin', 'Jadwal Movin', 'required');
    $this->form_validation->set_rules('comment', 'comment', 'required');
    //$this->form_validation->set_rules('captcha', 'Captcha', 'required');

    $nama             = $this->input->post('name',TRUE);
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
    $comment          = $this->input->post('comment',TRUE);
    //$captcha  = $this->input->post('captcha',TRUE);

    if($this->form_validation->run() == FALSE){
      $data['cap_img'] = $this -> _make_captcha();
      $data['cap_msg'] = "";
      $this->load->view('home',$data);
    }else {

      //if ( $this -> _check_capthca($captcha) ){

        $data = array(
                  'nama' => $nama,
                  'subject' => $subject,

                  'email' => $email,

                  'comment' => $comment,

      );

      $insert = $this->db->insert('contact', $data);


        if($insert){

          $captcha_result = 'Contact Us Indosan';

          $text = "Name : " . $nama . "<br>";
          $text .= "Subject : " . $subject . "<br>";
          $text .= "E-mail : " . $email . "<br>";
          //$text .= "Nama Perusahaan : " . $nama_perusahaan . "<br>";
          $text .= "Comment :  <br>";
          $text .= $comment;

          /*
          $this->load->library('PHPMailerAutoload');

          $mail = new phpmailer();
          # Principal settings

          // $mail->SMTPOptions = array(
          // 'ssl' => array(
          // 'verify_peer' => false,
          // 'verify_peer_name' => false,
          // 'allow_self_signed' => true
          // )
          // );

          $mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = "mail.indosan.com";
$mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = "admin@indosan.com";  // SMTP username
        $mail->Password = "f;iMyuVRb}&g"; //
$mail->SMTPSecure = 'none'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to
$mail->SMTPAutoTLS = false;
//$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)
//$mail->Hostname = “nama-hostname”;

$mail->From     = $email;
				$mail->FromName = $nama;

          //$mail->AddAddress("yudi@sketsa.net","Yudi");
        //  $mail->AddAddress("haru.wyndham@gmail.com","Haru");
          $mail->AddAddress("hey_abud@yahoo.com");
          //$mail->AddBCC("yudisketsa@gmail.com");



          $mail->IsHTML(true); // send as HTML
          # Embed images
          //$mail->AddEmbeddedImage('img/mailings/logo.gif', "logo_header");

          $mail->Subject = $subject;
          //$mail->Body = $this->load->view('email/mailing_view','',TRUE);
          $mail->Body       = $text;
          //$mail->AltBody = "This is the text-only body";
          */

          $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
        $headers .= 'To: arief <klayabancom@gmail.com>' . "\r\n";
$headers .= 'From: '.$nama.' <'.$email.'>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: hey_abud@yahoo.com' . "\r\n";


        $subject = 'Contact to INDOSAN';

  //$headers = 'From: BIOR <noreply@bior.com>'."\r\n".'Content-Type: text/html; charset=UTF-8';#FOR TEST

  $sending = mail('admin@indosan.com', $subject, $text, $headers);

        //if(!$mail->Send())
        if(!$sending)
        {
          echo "Message was not sent <br>";
          //echo "Mailer Error: " . $mail->ErrorInfo;
          exit;
        }
        else {
          echo "<script language='javascript'>alert('Thank you for your attention');</script>";
          ?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('home'); ?>'><?php
        }


        }
      // }else{
      //  $captcha_result = 'Security Code Invalid';
      // }

      $data['name'] = $nama;
      //$data['phone'] = $phone;
      $data['email'] = $email;
      $data['subject'] = $subject;
      $data['comment'] = $comment;
      $data['captcha'] = $comment;
      $data['cap_img'] = $this -> _make_captcha();
      $data['cap_msg'] = $captcha_result;
      //$this->load->view('contact-us',$data);
$this->load->view('home',$data);

    }


  }




     /**
     * Custom page backend.
     *
     * @return HTML
     **/
    public function page($slug)
    {

    }





  function _make_captcha()
    {
      //$this -> load -> plugin( 'captcha' );
      $vals = array(
        'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
        'img_url' => base_url() . 'captcha/', // URL for captcha img
        'img_width' => 160, // width
        'img_height' => 60, // height
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


    function test()
    {
      phpinfo();
    }

    function create_xml() {
  		$dom = new DOMDocument("1.0", "UTF-8");
  		$urlset = $dom->createElement("urlset");
  		$urlset->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

  		#Link home
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

  		#Link Web Development
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/pages/view/1/about-us");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

  		#Link Web Maintainance
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/product");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

  		#Link Contact Us
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/promo/view");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

      #Link Promo
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/berita/view");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

      #Link Promo
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/artikel/view");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

      #Link Promo
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/rekanan/view");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

      #Link Promo
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/gallery/view");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

      #Link Affiliation
  		$url = $dom->createElement("url");
  		$loc = $dom->createElement("loc","https://www.indosan.com/kontak");
  		$lastmod = $dom->createElement("lastmod", date('Y-m-d'));
  		$url->appendChild($loc);
  		$url->appendChild($lastmod);
  		$urlset->appendChild($url);

  		$portfolio = $this->db->order_by('product_id','desc')->get('product');

      //print_r($portfolio->row_array());

  		if($portfolio->num_rows() > 0){
  			foreach ($portfolio->result() as $key => $row) {

  				$url 			= $dom->createElement("url");
  				$loc 			= $dom->createElement("loc", base_url('product/detail').'/'.$row->product_id.'/'.url_title($row->product_name,'-',true));
  				$lastmod 	= $dom->createElement("lastmod", date('Y-m-d'));

  				$url->appendChild($loc);
  				$url->appendChild($lastmod);
  				$urlset->appendChild($url);

  			}
  		}

      $news = $this->db->order_by('articles_id','desc')->get('articles');

      if($news->num_rows() > 0){
  			foreach ($news->result() as $key => $row) {

  				$url 			= $dom->createElement("url");
  				$loc 			= $dom->createElement("loc", base_url('articles/detail').'/'.$row->articles_id.'/'.url_title($row->title,'-',true));
  				$lastmod 	= $dom->createElement("lastmod", $row->posting_date);

  				$url->appendChild($loc);
  				$url->appendChild($lastmod);
  				$urlset->appendChild($url);

  			}
  		}

      $articles = $this->db->order_by('articles_id','desc')->get('articles');

      if($articles->num_rows() > 0){
  			foreach ($articles->result() as $key => $row) {

  				$url 			= $dom->createElement("url");
  				$loc 			= $dom->createElement("loc", base_url('articles/detail').'/'.$row->articles_id.'/'.url_title($row->title,'-',true));
  				$lastmod 	= $dom->createElement("lastmod", $row->posting_date);

  				$url->appendChild($loc);
  				$url->appendChild($lastmod);
  				$urlset->appendChild($url);

  			}
  		}

  		$dom->appendChild($urlset);

  		$dom->save("sitemap.xml");

  		redirect('sitemap.xml');
  	}


    public function jamLayanan()
    {
        $data['name'] = "";
        $data['email']  ='';
        $data['comment']= '';
        $data['captcha'] = "";
        $data['cap_img'] = $this -> _make_captcha();
        $data['cap_msg'] = "";
        
        $this->load->view('design-frontend/jam-layanan',$data);
    }
    
    public function deposit()
    {
        $data['name'] = "";
        $data['email']  ='';
        $data['comment']= '';
        $data['captcha'] = "";
        $data['cap_img'] = $this -> _make_captcha();
        $data['cap_msg'] = "";
        
        $this->load->view('design-frontend/deposit',$data);
    }

    public function withdrawal()
    {
        $data['name'] = "";
        $data['email']  ='';
        $data['comment']= '';
        $data['captcha'] = "";
        $data['cap_img'] = $this -> _make_captcha();
        $data['cap_msg'] = "";
        
        $this->load->view('design-frontend/withdrawal',$data);
    }
}