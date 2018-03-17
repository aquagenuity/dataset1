<?php include $layout->header; ?>
<div class="row">
  <div class="col-md-12">

<h1>Test</h1>


<?php

    $html = null;

    // $items = ToxinType::GetAll();
    // foreach($items as $item){
    //   $html .= sprintf("<div>%s</div>", $item->toxin_type_name);
    // }

    $item = ToxinType::GetByCd('01');
    if($item){
      $html .= sprintf("<div>%s</div>", $item->toxin_type_name);
    }


    print $html;
?>

  </div>
</div>
<?php include $layout->footer; ?>



