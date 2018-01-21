<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class FixerApiData extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('PHPRequests'); //Se carga la librería para poder hacer requests
        $this->load->model('Currency_model', 'currency'); //cargamos modelo

    }

	public function save_data()
	{

		$base = 'MXN';
		$date = $this->input->post('date-rate');
		$request = Requests::get('https://api.fixer.io/'.$date.'?base=' . $base, array('Accept' => 'application/json'));
		if ($request->status_code == 200) {
		  $response = json_decode($request->body);
		  $USD = $response->rates->USD;
		  $CAD = $response->rates->CAD;
		  $JPY = $response->rates->JPY;
		  $GBP = $response->rates->GBP;
		  $EUR = $response->rates->EUR;
		  $date = $response->date;

		  $query_data = array(
		  			'date' => $date,
		  			'usd' => $USD,
		  			'cad' => $CAD,
		  			'jpy' => $JPY,
		  			'gbp' => $GBP,
		  			'eur' => $EUR	  
		  		);

		  var_dump($response);
		  $this->currency->save($query_data);
		  //$this->load->view('success_view');
		}
	}
}