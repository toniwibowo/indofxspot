<?php
class Contact extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['name'] = "";
		$data['email'] = "";
		$data['phone'] = "";
		$data['subject'] = '';
		$data['comment'] = "";
		$data['captcha'] = "";
		$data['cap_img'] = $this -> _make_captcha();
		$data['cap_msg'] = "";
		$this->load->view('contact-us',$data);
	}

	function send(){

		$this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('comment', 'comment', 'required');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required');

		$name 		= $this->input->post('nama',TRUE);
		$email 		= $this->input->post('email',TRUE);
		$phone 		= $this->input->post('phone',TRUE);
		$subject 	= $this->input->post('subject',TRUE);
		$comment 	= $this->input->post('comment',TRUE);
		$ip 			= $this->input->post('ip',TRUE);
		$captcha 	= $this->input->post('captcha',TRUE);

		if($this->form_validation->run() == FALSE){
			$data['cap_img'] = $this -> _make_captcha();
			$data['cap_msg'] = "";
			$this->load->view('contact-us',$data);
		}else {

			if ( $this -> _check_capthca($captcha) ){
				$insert =true;
				if($insert){

					$captcha_result = 'Contact Us Demo I Love Apartment Succeed';

					$text = "Name : " . $name . "<br>";
					$text .= "Phone : " . $phone . "<br>";
					$text .= "E-mail : " . $email . "<br>";
					$text .= "Subject : " . $subject . "<br>";
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
					$mail->IsSMTP();
					$mail->Host     = "localhost";
					$mail->SMTPAuth = true;     // turn on SMTP authentication
					$mail->Username = "admin@sketsa.net";  // SMTP username
					$mail->Password = "sketsa88"; // SMTP password

					$mail->From     = $email;
					$mail->FromName = $name;
					//$mail->AddAddress("yudi@sketsa.net","Yudi");
					$mail->AddAddress("haru.wyndham@gmail.com","Haru");
					$mail->AddBCC("hey_abud@yahoo.com");
					$mail->AddBCC("yudisketsa@gmail.com");



					$mail->IsHTML(true); // send as HTML
					# Embed images
					//$mail->AddEmbeddedImage('img/mailings/logo.gif', "logo_header");

					$mail->Subject = $subject;
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
						?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('contact'); ?>'><?php
					}
				}
			}else{
				$captcha_result = 'Security Code Invalid';
			}

			$data['name'] = $name;
			$data['phone'] = $phone;
	 		$data['email'] = $email;
			$data['subject'] = $subject;
			$data['comment'] = $comment;
			$data['captcha'] = $comment;
			$data['cap_img'] = $this -> _make_captcha();
			$data['cap_msg'] = $captcha_result;
			$this->load->view('contact-us',$data);
		}


	}

	function _make_captcha(){
	    //$this -> load -> plugin( 'captcha' );
	    $vals = array(
	      'img_path' => './captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
	      'img_url' => base_url() . 'captcha/', // URL for captcha img
	      'img_width' => 165, // width
	      'img_height' => 46, // height
	      'font_path'     => './fonts/inder-regular-webfont.ttf',
	      'expiration' => 3600 ,
	      );
	    // Create captcha
	    $cap = create_captcha( $vals );
	    // Write to DB
	    if ( $cap ) {
	      $data = array(
	        'captcha_id' => '',
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

		if ( $row -> count > 0 ){
				return true;
		}
				return false;

		}


}
