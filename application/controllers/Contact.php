<?php
class Contact extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['nama'] = "";
		$data['no_telp'] = "";
		$data['budget'] = "";
		$data['harapan_area'] = '';
		$data['nama_apartemen'] = "";
		$data['nama_perusahaan']='';
		$data['email']	='';
		$data['jadwal_showing']= '';
		$data['jadwal_movin'] ='';
		$data['perkiraan_include_pajak'] = '';
		$data['alamat_kantor'] = '';
		$data['keinginan_lain'] = '';
		$data['comment']= '';
		$data['captcha'] = "";
		$data['cap_img'] = $this -> _make_captcha();
		$data['cap_msg'] = "";
		$this->load->view('contact-us',$data);
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

		$nama 						= $this->input->post('name',TRUE);
		 $subject 					= $this->input->post('subject',TRUE);
		// $budget 					= $this->input->post('budget',TRUE);
		// $harapan_area				= $this->input->post('harapan_area',TRUE);
		// $nama_apartemen				= $this->input->post('nama_apartemen',TRUE);
		// $nama_perusahaan 			= $this->input->post('nama_perusahaan',TRUE);
		$email 						= $this->input->post('email',TRUE);
		// $jadwal_showing 			= $this->input->post('jadwal_showing',TRUE);
		// $jadwal_movin 				= $this->input->post('jadwal_movin',TRUE);
		// $perkiraan_include_pajak	= $this->input->post('perkiraan_include_pajak',TRUE);
		// $alamat_kantor				= $this->input->post('alamat_kantor',TRUE);
		// $keinginan_lain				= $this->input->post('keinginan_lain',TRUE);
		$comment 					= $this->input->post('comment',TRUE);
		//$captcha 	= $this->input->post('captcha',TRUE);

		if($this->form_validation->run() == FALSE){
			$data['cap_img'] = $this -> _make_captcha();
			$data['cap_msg'] = "";
			$this->load->view('contact-us',$data);
		}else {

			//if ( $this -> _check_capthca($captcha) ){

				$data = array(
        					'nama' => $nama,
        					'subject' => $no_telp,
        					
        					'email' => $email,
        					
        					'comment' => $comment,

			);

			$insert = $this->db->insert('contact', $data);

				
				if($insert){

					$captcha_result = 'Contact Us Indosan';

					$text = "Name : " . $name . "<br>";
					$text .= "Subject : " . $subject . "<br>";
					$text .= "E-mail : " . $email . "<br>";
					//$text .= "Nama Perusahaan : " . $nama_perusahaan . "<br>";
					$text .= "Comment :  <br>";
					$text .= $comment;

					$this->load->library('PHPMailerAutoload');

					$mail = new phpmailer();
					# Principal settings

				 $mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = "mail.indosan.com";
$mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = "admin@indosan.com";  // SMTP username
        $mail->Password = "f;iMyuVRb}&g"; //
$mail->SMTPSecure = 'none'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to
$mail->SMTPAutoTLS = false;
$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)
//$mail->Hostname = “nama-hostname”;

					$mail->From     = $email;
					$mail->FromName = $nam;
					//$mail->AddAddress("yudi@sketsa.net","Yudi");
				//	$mail->AddAddress("haru.wyndham@gmail.com","Haru");
					$mail->AddAddress("hey_abud@yahoo.com");
					//$mail->AddBCC("yudisketsa@gmail.com");



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
						?><meta http-equiv='refresh' content='0;URL=<?php echo site_url('home'); ?>'><?php
					}
				}
			// }else{
			// 	$captcha_result = 'Security Code Invalid';
			// }

			$data['name'] = $name;
			//$data['phone'] = $phone;
	 		$data['email'] = $email;
			$data['subject'] = $subject;
			$data['comment'] = $comment;
			$data['captcha'] = $comment;
			$data['cap_img'] = $this -> _make_captcha();
			$data['cap_msg'] = $captcha_result;
			//$this->load->view('contact-us',$data);
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
