<?php

class Users_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function email($mailTo, $subject, $message, $mailFrom, $mailName)
    {
        $this->load->library('email');

        $config['smtp_host'] = 'mail.lokalan.co.id';
        $config['smtp_user'] = 'indofxspot@lokalan.co.id';
        $config['smtp_pass'] = 'Admin1@#$';
        $config['smtp_port'] = 587;
        $config['mailtype']  = 'html';

        $this->email->initialize($config);

        $this->email->from($mailFrom, $mailName);
        $this->email->to($mailTo);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send(FALSE);

        return $this->email->print_debugger(array('headers'));
    }
}