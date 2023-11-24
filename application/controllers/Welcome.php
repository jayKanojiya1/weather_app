<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	 public function getWeatherData(){
		$location = $this->input->post("location");
		$api_key = "185377efab4986a3eaf47e3111e1719e";
		$api_url = "https://api.openweathermap.org/data/2.5/forecast?q=$location&appid=$api_key";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		echo  $response;


	 }



}

?>
