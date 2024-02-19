<?php 
use PHPUnit\Framework\TestCase;

require './productsPage.php';
require './templates/main-header.php';

class calculateCartTest extends TestCase
{
    public function testCalculateTotal()
    {

        $_SESSION["user_firstName"] = "Paul";

        $cart = array(
            array('CarMake' => 'Toyota', 'CarModel' => 'Corolla', 'CarReg' => '123-ABC', 'CarPrice' => 10000),
            array('CarMake' => 'Honda', 'CarModel' => 'Civic', 'CarReg' => '456-DEF', 'CarPrice' => 15000),
            array('CarMake' => 'Ford', 'CarModel' => 'Fiesta', 'CarReg' => '789-GHI', 'CarPrice' => 12000)
        );
        $expectedResult = array('total' => 37000, 'VRT' => 5180, 'remainingTotal' => 42180);

        $result = calculateTotal($cart);

        $this->assertEquals($expectedResult, $result);
    }
}

?>