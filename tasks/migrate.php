<?php

require_once "../app/Models/Car.php";
use App\Models\Car;

$sql = require_once "../app/Services/Sql.php";

$query = "
  CREATE SCHEMA IF NOT EXISTS `dealer`;
  USE `dealer`;
  DROP TABLE IF EXISTS `cars`;
  CREATE TABLE `cars` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `condition` enum('used','new') NOT NULL,
    `year` int(11) NOT NULL,
    `make` varchar(128) NOT NULL,
    `model` varchar(128) NOT NULL,
    `mileage` int(11) NOT NULL,
    `stock_number` varchar(128) NOT NULL,
    `vin` varchar(128) NOT NULL,
    `props` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
    PRIMARY KEY (`id`)
  );
";

$sql->query($query);

fwrite(STDOUT, 'Database created! Seeding inventory');

$makeModels = require_once "../constants/make_models.php";
$specs = require_once "../constants/specs.php";
$conditions = ['new', 'used', 'used'];
$colors = require_once "../constants/colors.php";

for ($i = 0; $i < 100; $i++) {

    $condition = $conditions[array_rand($conditions)];
    $make = array_rand($makeModels);
    $model = array_rand($makeModels[$make]);
    $mileage = $condition === 'used' ? rand(10000, 90000) : rand(10,500);
    $year = $condition === 'new' ? rand(2020, 2021) : rand(2007, 2019);
    $stock_number = rand(10000, 90000);
    $vin = substr(str_shuffle('123456789QWERTYUIOPASDFGHJKLZXCVBNM23456789'), -17);
    $props = [
      'price' => (int)((string)rand(10,40)."999"),
      'image' => $makeModels[$make][$model],
      'specs' => [],
      'color' => $colors[array_rand($colors)],
    ];

    for ($s = 0; $s < 10; $s++) {
        $props['specs'][] = $specs[array_rand($specs)];
    }

    $props['specs'] = array_unique($props['specs']);

    $car = new Car(compact(
        'condition',
        'year',
        'make',
        'model',
        'mileage',
        'stock_number',
        'vin',
        'props'
      ));

    $car->save();
    fwrite(STDOUT, '.');
}

$sql->close();

?>
