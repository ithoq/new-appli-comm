<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function index()
	{
		//if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_categories');

					$result_cat_parent = $this->My_categories->get_all_parent_cat();

					foreach ($result_cat_parent as $row_cat_parent) {

						$result_cat_child = $this->My_categories->get_child_cat($row_cat_parent->id);

						foreach ($result_cat_child as $row_cat_child) {

							$tab_cat_child[] = [
								'id' => $row_cat_child->id,
								'titre' => $row_cat_child->titre,
							];

						}

						$result[] = [
							'id' => $row_cat_parent->id,
							'titre' => $row_cat_parent->titre,
							'cat_child' => $tab_cat_child
						];
					}

					$data = array(
							"result" => $result,
					);

					$this->load->view('header', $data);
					$this->load->view('categories');
					$this->load->view('footer');

			/*} else {
					$this->load->view('login');
			}*/
	}

	public function exporter()
	{
		//if ($_SESSION["is_connect"] == TRUE){

		$this->load->model('My_categories');

		$result_cat_parent = $this->My_categories->get_all_parent_cat();

		foreach ($result_cat_parent as $row_cat_parent) {

			$result_cat_child = $this->My_categories->get_child_cat($row_cat_parent->id_cat);

			foreach ($result_cat_child as $row_cat_child) {

				$tab_cat_child[] = [
					'id' => $row_cat_child->id_cat,
					'titre' => $row_cat_child->titre,
				];

			}

			$result[] = [
				'id' => $row_cat_parent->id_cat,
				'titre' => $row_cat_parent->titre,
				'cat_child' => $tab_cat_child
			];
			}

			$data = array(
					"result" => $result,
			);

			$this->load->view('header', $data);
			$this->load->view('categories_exporter');
			$this->load->view('footer');

			/*} else {
					$this->load->view('login');
			}*/
	}


	public function export_csv ()
	{
		$this->load->model('My_listes');



		$this->load->view ('categories_xls');
	}

	public function ajouter()
	{

		//if ($_SESSION["is_connect"] == TRUE){

					$this->load->view('header');
					$this->load->view('categories_ajouter');
					$this->load->view('footer');

			/*} else {
					$this->load->view('login');
			}*/

	}

	public function modifier()
	{

		//if ($_SESSION["is_connect"] == TRUE){

			$this->load->model('My_categories');

			$id = $this->uri->segment(3, 0);

				$result = $this->My_categories->get_cat_by_id($id);

				$data = array(
					"result" => $result,
				);

				$this->load->view('header', $data);
				$this->load->view('categories_modifier');
				$this->load->view('footer');

			/*} else {
					$this->load->view('login');
			}*/
	}

	public function add()
	{

		if ($_SESSION["is_connect"] == TRUE){

	        $this->My_common->insert_data ("categorie", $_POST);

			redirect('categories');

    	} else {
        	$this->load->view('login');
    	}

	}


	public function delete()
	{

		if ($_SESSION["is_connect"] == TRUE){

	        $this->My_common->delete_data("categorie", $this->input->post('id'));

			redirect('categories');

    	} else {
        	$this->load->view('login');
    	}

	}

	public function update()
	{

		if ($_SESSION["is_connect"] == TRUE){

			$data = array (
				"id" 		=> $this->input->post('id'),
				"titre" 	=> $this->input->post('titre'),
				"id_parent" => $this->input->post('id_parent'),
			);

	        $this->My_common->update_data("categorie", "id", $this->input->post('id'), $data);

			redirect('categories');

    	} else {
        	$this->load->view('login');
    	}

	}

}
