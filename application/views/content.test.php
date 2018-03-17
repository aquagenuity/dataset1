<?php include $layout->header; ?>
<div class="row">
  <div class="col-md-12">

<h1>Test</h1>


<?php

  $item = new Car();
  $item->year = 2000;
  $item->make = 'Honda';
  $item->model = 'Accord';
  $item->color = 'Silver';
  $item->price = 23000;
  $item->Save();

?>

  </div>
</div>
<?php include $layout->footer; ?>



