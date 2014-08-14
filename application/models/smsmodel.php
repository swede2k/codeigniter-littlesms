<?php

class Smsmodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
		$this->config->load('sms', TRUE);
    }

    public function sign($params) {
		ksort($params); // сортируем значения параметров функции по ключу
		return md5(sha1($this->config->item('login', 'sms') . join('', $params) . $this->config->item('apiKey', 'sms')));
	}

    function request($phone, $text) {
        $url = 'https://littlesms.ru/api/message/send';
		$params = array(
            'recipients'    => $phone,
            'message'       => $text,
            'sender'        => $this->config->item('sender', 'sms')
		);
        $post = 'user='. $this->config->item('login', 'sms') .'&recipients='. $phone .'&sender='.$this->config->item('sender', 'sms').'&message='.$text.'&sign='.$this->sign($params).'';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_USERAGENT, 'SMS Bot');
		$data = curl_exec($ch);
		curl_close($ch);
        return $data;
    }

}