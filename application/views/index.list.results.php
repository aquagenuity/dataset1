<?php include $layout->header; ?>
<div class="row">
  <div class="col-md-12">
    <h1>Results</h1>
    <?php

$legend = <<<BLOCK
    <div class="legend">
      <h2>Legend</h2>
      <div class="above-health-limit"><span></span> Above Health Limit</div>
      <div class="above-state-limit"><span></span> Above State Limit</div>
      <div class="above-national-limit"><span></span> Above National Limit</div>
      <div class="above-state-average"><span></span> Above State Average</div>
      <div class="above-national-average"><span></span> Above National Average</div>
    </div>
BLOCK;


      $html = null;

      if($items){

        $item = $items[0];
        $zip_cd = $item->zip_cd;
        $html .= "<h2>Zip Code: $zip_cd <a class=\"search-again\" href=\"/\">Search Again</a></h2>";
        $html .= "<hr style=\"margin-bottom:15px;\"/>";
        $html .= $legend;

        $utility_names = array();
        foreach($items as $item){
          $utility_name = $item->utility_name;
          if(!in_array($utility_name, $utility_names)){
            $utility_names[] = $utility_name;
          }
        }

        foreach($utility_names as $utility_name){
          $html .= "<h2>$utility_name</h2>";
          $html .= "<table class=\"toxin-type-names\">";
          foreach($items as $item){
            if($item->utility_name == $utility_name){

              $zip_id = $item->zip_id;
              $zip_cd = $item->zip_cd;
              $toxin_type_cd = $item->toxin_type_cd;
              $health_risk_type_cd = $item->health_risk_type_cd;
              $filter_type_cd = $item->filter_type_cd;
              $amount = $item->amount;
              $utility_id = $item->utility_id;
              $sample_dtm = $item->sample_dtm;
              $creation_user_id = $item->creation_user_id;
              $creation_dtm = $item->creation_dtm;
              $last_update_user_id = $item->last_update_user_id;
              $last_update_dtm = $item->last_update_dtm;
              $toxin_type_name = $item->toxin_type_name;
              $health_risk_type_name = $item->health_risk_type_name;
              $filter_type_name = $item->filter_type_name;
              $utility_name = $item->utility_name;
              $state_type_cd = $item->state_type_cd;
              $state_type_name = $item->state_type_name;
              $health_limit = $item->health_limit;
              $state_limit = $item->state_limit;
              $national_limit = $item->national_limit;
              $state_average = $item->state_average;
              $national_average = $item->national_average;
              $above_health_limit = $item->above_health_limit;
              $above_state_limit = $item->above_state_limit;
              $above_national_limit = $item->above_national_limit;
              $above_state_average = $item->above_state_average;
              $above_national_average = $item->above_national_average;
              $toxin_total = $item->toxin_total;
              $toxin_count = $item->toxin_count;
              $toxin_rating = $item->toxin_rating;

              $class_name = "toxin-type-name";
              if($above_health_limit){
                $class_name = sprintf("%s above-health-limit", $class_name);
              }else if($above_state_limit){
                $class_name = sprintf("%s above-state-limit", $class_name);
              }else if($above_national_limit){
                $class_name = sprintf("%s above-national-limit", $class_name);
              }else if($above_state_average){
                $class_name = sprintf("%s above-state-average", $class_name);
              }else if($above_national_average){
                $class_name = sprintf("%s above-national-average", $class_name);
              }

              $amount = number_format($amount, 2);

              $html .= "<tr class=\"$class_name\"><td>$toxin_type_name</td><td class=\"amount\">$amount ppm</td></tr>";

            }
          }
          $html .= "</table>";
        }

      }else{
        $html .= "<div>No results found.</div>";
      }

      $html .= $legend;

      print $html;
    ?>


  </div>
</div>
<?php include $layout->footer; ?>
