<?php

require_once dirname(__FILE__)."/../app/Models/Car.php";

use PHPUnit\Framework\TestCase;
use App\Models\Car;

class CarTest extends \PHPUnit_Framework_TestCase {
    public function testArray2JSON()
    {
        $car = new Car([
            "props" => '{"color": "red"}'
        ]);

        $this->assertTrue(is_array($car->props));
        $this->assertTrue($car->props['color'] === 'red');
    }
}

?>
