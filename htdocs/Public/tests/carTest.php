<?php

class carTest extends PHPUnit\Framework\TestCase{



    public function testClass(){

        require 'car.php';
       

          $car = new car("234","01-D-213",234,"Ford","Red","./test","Mondeo",1.5,45000);

          $this->assertSame('234', $car->getCarVin());
          $this->assertSame('01-D-213', $car->getCarReg());
          $this->assertSame(234, $car->getCarPrice());
          $this->assertSame('Ford', $car->getCarMake());
          $this->assertSame('Red', $car->getCarColor());
          $this->assertSame('./test', $car->getCarImage());
          $this->assertSame('Mondeo', $car->getCarModel());
          $this->assertSame(1.5, $car->getCarEngineSize());
          $this->assertSame(45000, $car->getCarMileage());

          

        require 'customer.php';

         $customer = new customer("Paul","McKeon","paulmckeon007@gmail.com","25","Ireland","Hackme123!",1);

         $this->assertSame("Paul", $customer->getFirstname());
         $this->assertSame("McKeon", $customer->getLastname());
         $this->assertSame("paulmckeon007@gmail.com", $customer->getEmail());
         $this->assertSame("25", $customer->getAge());
         $this->assertSame("Ireland", $customer->getLocation());
         $this->assertSame("Hackme123!", $customer->getPassword());
         $this->assertSame(1, $customer->getIsadmin());

    }
}