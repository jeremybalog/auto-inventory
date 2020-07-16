<a href="<?=$slug; ?>" class="col-4">
  <div class="tile">
    <h3><?=$title; ?></h3>
    <?=$svg; ?>
    <div class="price">
      <span>
        $<?=number_format($props['price']); ?>
      </span>
    </div>
    <div class="specs">
      <div>Odometer: <strong><?=number_format($mileage); ?> miles</strong></div>
      <div>Color: <strong><?=preg_replace('#([A-Z])#', ' $1', $props['color']); ?></strong></div>
      <div>Stock Number: <em><?=$stock_number; ?></em></div>
    </div>
  </div>
</a>
