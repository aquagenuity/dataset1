<?php

class IndexController extends BaseController
{
	public function index()
	{
    global $post_back, $double_post_back;
    $cmd = $_POST['cmd'];

    if($post_back && !$double_post_back){


      $zip_cd = request('zip_cd');
      $utility_id = request('utility_id');

      $items = array();

      if($zip_cd){
        if($utility_id){
          $items = Zip::GetByCdUtility($zip_cd, $utility_id);
        }else{
          $items = Zip::GetByCd($zip_cd);
        }
      }else if($utility_id){
        $items = Zip::GetByUtility($utility_id);
      }else if($id){
        $item = Zip::GetById($id);
        if($item) $items[] = $item;
      }else{
        $items = Zip::GetAll();
      }

      $toxin_rating = 0;

      $titems = ToxinType::GetAll();
      $toxin_total = count($titems);

      $toxin_type_cds = array();
      foreach($items as $item){
        $toxin_type_cd = $item->toxin_type_cd;
        if(!in_array($toxin_type_cd, $toxin_type_cds)){
          $toxin_type_cds[] = $toxin_type_cd;
        }
      }
      $toxin_count = count($toxin_type_cds);

      $toxin_rating = ceil((floatval($toxin_total - $toxin_count)/floatval($toxin_total)) * 10);

      if($toxin_rating < 1) $toxin_rating = 1;

      foreach($items as $item) {
        $item->extend();
        $item->toxin_total = $toxin_total;
        $item->toxin_count = $toxin_count;
        $item->toxin_rating = $toxin_rating;
      }

      $this->registry->template->items = $items;
      $this->registry->template->scripts = array('/js/jquery.validate.js','/js/index.list.results.js');
      $this->registry->template->show('index.list.results.php');

    }else{
      $this->registry->template->scripts = array('/js/jquery.validate.js','/js/index.list.js');
      $this->registry->template->show('index.list.php');

    }

	}

}
