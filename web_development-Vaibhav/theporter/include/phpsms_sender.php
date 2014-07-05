<?php
class SMS_Sender
{
	var $post_data = array();
	var $exotel_sid; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
	var $exotel_token; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
	function SMS_Sender()
	{
		//Constructor to initialise all SMS Gateway Defaults
		// 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
		// For promotional, this will be ignored by the SMS gateway
		$this->post_data['From']='9223183143';// Enter Exoter Number
		$this->exotel_sid='thporter';
		$this->exotel_token='8973d82cb92db6a5b926e9528086f09042768802';	
	}
	function AddReceipient($number)
	{
		$this->post_data['To']=$number;		
	}
	function AddMessage($msg)
	{
		$this->post_data['Body']=$msg;
	}
		
 	function Send()
	{
	
		$url = "https://".$this->exotel_sid.":".$this->exotel_token."@twilix.exotel.in/v1/Accounts/".$this->exotel_sid."/Sms/send";
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->post_data));	
		$http_result = curl_exec($ch);
		$error = curl_error($ch);
		$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
		
		curl_close($ch);
		return $http_code;
	}
}
?>