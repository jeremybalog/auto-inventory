<div class="container">
  <h1><?=$car->title(); ?></h1>
  <div class="row vdp">
    <div class="col-8">
      <?=$car->svg(); ?></h1>
    </div>
    <div class="col-4">
      <div class="price">$<?=number_format($car->props['price']); ?></div>
      <div class="cta">
        <button onClick="window.alert('Get ePrice clicked');">Get ePrice!</button>
        <button onClick="window.alert('Apply for Credit clicked');">Apply for Credit!</button>
      </div>
      <div>Odometer: <strong><?=number_format($car->mileage); ?> miles</strong></div>
      <div>Color: <strong><?=preg_replace('#([A-Z])#', ' $1', $car->props['color']); ?></strong></div>
      <div>Stock Number: <em><?=$car->stock_number; ?></em></div>

      <h4>Specifications</h4>
      <ul class="specs">
        <?php
          foreach ($car->props['specs'] as $key => $value) {
            echo "<li>{$value}</li>";
          }
        ?>
      </ul>
    </div>
  </div>
  <?php
    if (!empty($similars)) {
      echo "<h3>Similar Vehicles Available</h3>";
      echo "<div class=\"row\">";

      foreach($similars as $similar) {
        echo $similar->renderTile();
      }

      echo "</div>";
    }
  ?>
  </div>
</div>
