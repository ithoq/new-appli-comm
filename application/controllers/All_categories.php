<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_categories extends CI_Controller  {

  public function index()
	{
		//if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_categories');

	        $result = $this->My_categories->get_all_cat();

          foreach ($result as $row) {

              $data[] = array('id' => $row->id_cat, 'text' => $row->titre);

          }

          header('Content-Type: application/json');
          echo json_encode ($data);

    	/*} else {
        	$this->load->view('login');
    	}*/
	}


}
