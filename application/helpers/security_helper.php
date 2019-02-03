<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function isUser() {
    $CI = &get_instance();
    if (!$CI->session->userdata('user_key')) {
        $CI->session->sess_destroy();
        return redirect('/');
    }
    return true;
}

function isAdmin() {
    $CI = &get_instance();
    if ($CI->session->userdata('role') == 1) {
        return true;
    }
    return false;
}

//custom function
if (!function_exists('send_email')) {
    function send_email($options)
    {
        $CI =& get_instance();
        $CI->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => SMTP_HOST,
            'smtp_port' => SMTP_PORT,
            'smtp_user' => SMTP_USERNAME,
            'smtp_pass' => SMTP_PASSWORD,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => true,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );

        $CI->email->initialize($config);

        if (isset($options['from'])) {
            $CI->email->from($options['from']);
        } else {
            $CI->email->from(SITE_FROM_EMAIL, SITE_NAME);
        }
        if(is_array($options['to'])){
            $CI->email->to(join(',', $options['to']));    
        }else{
            $CI->email->to($options['to']);    
        }        

        $CI->email->subject($options['subject']);
        $CI->email->message($options['message']);

        // send email
        return $CI->email->send();
    }
}
?>