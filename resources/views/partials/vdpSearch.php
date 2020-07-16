<div class="container">
    <h1 class="center">Browse <?=$count; ?> <?=$count > 0 && !empty($_GET['condition']) ? ucwords($_GET['condition']) : ''; ?> <?=$count > 0 && !empty($_GET['make']) ? $_GET['make'] : ''; ?> <?=$count > 0 && !empty($_GET['model']) ? $_GET['model'] : ''; ?> <?=empty($model) ? 'vehicles' : ''; ?> for sale</h1>
    <div class="row facets">
      <div class="col-3">
        <h4>Condition:</h4>
        <select id="selectCondition" name="condition">
          <option value="">All Conditions</option>
          <?php
            foreach ($facets['condition'] as $item) {
              extract($item);
              $selected = !empty($_GET['condition']) && $condition == $_GET['condition'] ? 'selected' : '';
              $display = ucwords($condition);
              echo "<option value=\"{$condition}\" {$selected}>{$display} ({$count})</option>";
            }
           ?>
        </select>
      </div>

      <div class="col-3">
        <h4>Year:</h4>
        <select id="selectYear" name="year">
          <option value="">All Years</option>
          <?php
            foreach ($facets['year'] as $item) {
              extract($item);
              $selected = $year == !empty($_GET['year']) && $_GET['year'] ? 'selected' : '';
              echo "<option value=\"{$year}\" {$selected}>{$year} ({$count})</option>";
            }
           ?>
        </select>
      </div>

      <div class="col-3">
        <h4>Make:</h4>
        <select id="selectMake" name="make">
          <option value="">All Makes</option>
          <?php
            foreach ($facets['make'] as $item) {
              extract($item);
              $selected = !empty($_GET['make']) && $make == $_GET['make'] ? 'selected' : '';
              echo "<option value=\"{$make}\" {$selected}>{$make} ({$count})</option>";
            }
           ?>
        </select>
      </div>

      <div class="col-3">
        <h4>Model:</h4>
        <select id="selectModel" name="model" <?=empty($_GET['make']) ? 'disabled' : ''; ?>>
          <option value="">All Models</option>
          <?php
            foreach ($facets['model'] as $item) {
              extract($item);
              $selected = !empty($_GET['model']) && $model == $_GET['model'] ? 'selected' : '';
              echo "<option value=\"{$model}\" {$selected}>{$model} ({$count})</option>";
            }
           ?>
        </select>
      </div>
    </div>
    <div class="row">
      <?php
        if (!empty($cars)) {
          foreach($cars as $car) {
            echo $car;
          }
        } else {
          echo '<div class="center"><strong>No cars found!</strong></div>';
        }
      ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="pagination">
              <?php
                $params = [
                  'condition',
                  'make',
                  'model',
                  'page',
                  'year',
                ];

                $currentPage = $_GET['page'] ?? 1;

                $i = 1;
                while ($i <= $pages) {
                  $get = $_GET;
                  $get['page'] = $i;

                  $terms = [];
                  foreach ($params as $param) {
                    if (!empty($get[$param])) {
                      $terms[] = "{$param}={$get[$param]}";
                    }
                  }

                  $queryString = implode('&', $terms);

                  $classNames = $i == $currentPage ? 'page active' : 'page';

                  echo "<a href=\"/?{$queryString}\" class=\"{$classNames}\">{$i}</a>";

                  $i++;
                }
               ?>
         </div>
     </div>
  </div>
</div>

<script src="/js/search.js"></script>
