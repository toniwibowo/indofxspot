<?php
class Blog extends MX_Controller{

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

	public function __construct(){
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
        $this->home = $template['home'];

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


        $this->load->model("M_blog");
	}

	public function view(){
		$data = $this->M_blog->viewjoin();
		$this->load->view('blog',$data);
	}

	function detail($id){

		$data['query'] = $this->db->query("select * from articles where articles_id = '$id'");
		//$data['query2'] =$this->db->query("select * from imagenews where news_id = '$news_id'");

			//*=======================Perhitungan Hit Counter================================*/

			//$found_ip = $this->log($news_id);
			$found_ip = true;
			//Jika Ip tidak ada di file
			//Maka Update Hit Article
			if(!$found_ip){
            $sql = "update news set hits = hits + 1 WHERE news_id = '$news_id'";
            $this->db->query($sql);
             // $hit = $news->hits +1;
              //$data = array('hits'=>$hit);
             // $news2 = $this->sketsa_news_model->update_by_id($news->id_news,$data);
              //$news = $this->sketsa_news_model->get_by_slug($slug);

			}

			//*===============================End Perhitungan Hit Counter====================================================*/

    //echo 'te4';
    $this->load->view('blog-detail',$data);
  }


	public function log($id_article){

	  $ip_address = $_SERVER["REMOTE_ADDR"];
      $log_file = file(base_url().'ip/blog/'.'log.txt');
      $found_log = false;
      $log_current = $_SERVER["REMOTE_ADDR"].'/'.date('Y-m-d').'/'.$id_article;

		foreach($log_file as $l) {
			// echo trim ($l).'===='.$log_current.'</br>'; // -- for debugging purposes

			$log_item = trim($l);
			// echo $ip_item;
			//Jika ada history di log
			if ($log_current==$log_item){
				$found_log = true;
				break;
			}


        }


		if($found_log==false){

          $filename = './ip/blog/log.txt';
          //echo $filename;
          $handle = fopen($filename, 'a');
          //$data = fgets($handle);
          //echo $data;        //  $current = fread($handle, filesize($filename));
          //echo $current; // for debugging - current value in counter
          //fclose($handle);
          $ip = $_SERVER["REMOTE_ADDR"].'/'.date('Y-m-d').'/'.$id_article."\n";
          //$handle = fopen($filename, 'w');
          fwrite($handle, $ip);
          fclose($handle);

          //update Log lagi

		}

      return $found_log;

	}
}
