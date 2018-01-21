<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');


class ShowDataApi extends REST_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('PHPRequests'); //Se carga la librería para poder hacer requests
        $this->load->model('Currency_model', 'currency'); //cargamos modelo

    }

    public function get_currencyhistory(){
    		$this->load->model("Modulos_model");
			$all_history = $this->currency->get_all();

			$tam = count($all_history);
			$currency_arr;

			for($i=0 ; $i<$tam ; $i++){
				$date = parse_url($all_videos[$i]['url_video'], PHP_URL_HOST);
				$usd = $all_videos[$i]['url_video'];
				$cad = $all_videos[$i]['url_img'];
				$jpy = $all_videos[$i]['title_vid'];
				$gbp = $all_videos[$i]['description_vid'];
				$eur = $all_videos[$i]['title'];

				$currency_arr[$i]=[
						"date" => $id_url,
						"usd" => 1,
						"cad" => $code,
						"jpy" => $url,
						"gbp" => $title,
						"eur" => $desc
					];

			}	

			var_dump($currency_arr);	
    }

}    