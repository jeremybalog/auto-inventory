<?php

namespace App\Http\Controllers;

use App\Kernel\ViewController;
use App\Models\Car;

class CarController extends ViewController
{
    private static function sql()
    {
        return require_once "../app/Services/Sql.php";
    }

    public static function index()
    {
        $params = [
          'title' => 'Inventory Search',
          'canonical' => '/',
          'metaDesc' => 'Search hundreds of high quality cars.',
          'main' => ''
        ];

        $car = new Car();

        $results = $car->search($_GET);

        $cars = [];
        while ($row = $results->fetch_assoc()) {
            $cars[] = (new Car($row))->renderTile();
        }

        $count = $car->searchCount($_GET);

        $facets = $car->searchFacets($_GET);

        $pages = floor($count / $car->perPage);

        $params['main'] = self::renderView('partials/vdpSearch', compact('facets', 'cars', 'count', 'pages'));

        self::render($params);
    }

    public static function get($id)
    {
      $params = [
        'title' => 'VDP',
        'canonical' => '',
        'metaDesc' => '',
        'main' => ''
      ];

      $carSearch = new Car();

      $rows = $carSearch->search(compact('id'));
      $row = $rows->fetch_assoc();

      if (empty($row)) {
          http_response_code(404);
          self::render();
      } else {
          $car = new Car($row);

          $params['title'] = $car->title();
          $params['canonical'] = $car->slug();
          $params['metaDesc'] = "{$car->title()} for sale";

          $rows = $carSearch->searchSimilar([
                    'id' => $id,
                    'make' => $car->make,
                    'model' => $car->model
                  ]);

          $similars = [];
          while ($row = $rows->fetch_assoc()) {
              $similars[] = new Car($row);
          }

          $params['main'] = self::renderView('partials/vdp', compact('car', 'similars'));

          self::render($params);
      }
    }
}

?>
