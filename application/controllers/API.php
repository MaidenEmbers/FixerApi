<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');


class Api extends REST_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('PHPRequests'); //Se carga la librería para poder hacer requests
        $this->load->model('Currency_model', 'currency'); //cargamos modelo

    }

    public function currencyhistory_get(){
			$all_history = $this->currency->get_all();

			$tam = count($all_history);
			$currency_arr;

			for($i=0 ; $i<$tam ; $i++){
				$date = $all_history[$i]['date'];
				$usd = $all_history[$i]['usd'];
				$cad = $all_history[$i]['cad'];
				$jpy = $all_history[$i]['jpy'];
				$gbp = $all_history[$i]['gbp'];
				$eur = $all_history[$i]['eur'];

				$currency_arr[$i]=[
						"date" => $date,
						"usd" => $usd,
						"cad" => $cad,
						"jpy" => $jpy,
						"gbp" => $gbp,
						"eur" => $eur
					];

			}	

			echo $this->response($currency_arr, 200); 

            exit;	
    }

    public function curr_bymonth_get(){  //get currency history by month
    		$month = $this->input->get('month');
			$curr_month = $this->currency->get_by_month($month);

			$tam = count($curr_month);
			$currency_arr;

			for($i=0 ; $i<$tam ; $i++){
				$date = $curr_month[$i]['date'];
				$usd = $curr_month[$i]['usd'];
				$cad = $curr_month[$i]['cad'];
				$jpy = $curr_month[$i]['jpy'];
				$gbp = $curr_month[$i]['gbp'];
				$eur = $curr_month[$i]['eur'];

				$currency_arr[$i]=[
						"date" => $date,
						"usd" => $usd,
						"cad" => $cad,
						"jpy" => $jpy,
						"gbp" => $gbp,
						"eur" => $eur
					];

			}	

			echo $this->response($currency_arr, 200); 

            exit;	
    }

    public function by_currency_get(){  //get currency history by currency
    		$currency = $this->input->get('currency');
			$curr = $this->currency->get_by_curr($currency);

			$tam = count($curr);
			$currency_arr;

			for($i=0 ; $i<$tam ; $i++){
				$date = $curr[$i]['date'];
				$select_curr = $curr[$i][$currency];

				$currency_arr[$i]=[
						"date" => $date,
						"".$currency => $select_curr
					];

			}	

			echo $this->response($currency_arr, 200); 

            exit;	
    }

}    