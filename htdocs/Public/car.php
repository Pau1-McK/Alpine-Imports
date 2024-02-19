<?php
require "../src/DBconnect.php";
class car
{

    public $CarVin;
    public $CarReg;
    public $CarPrice;
    public $CarMake;
    public $CarColor;
    public $CarImage;
    public $CarModel;
    public $CarEngineSize;
    public $CarMileage;


    public function __construct($CarVin, $CarReg, $CarPrice, $CarMake, $CarColor,$CarImage, $CarModel, $CarEngineSize, $CarMileage)
    {

        $this->CarVin = $CarVin;
        $this->CarReg = $CarReg;
        $this->CarPrice = $CarPrice;
        $this->CarMake = $CarMake;
        $this->CarColor = $CarColor;
        $this->CarImage = $CarImage;
        $this->CarModel = $CarModel;
        $this->CarEngineSize = $CarEngineSize;
        $this->CarMileage = $CarMileage;


    }

    /**
     * @return mixed
     */
    public function getCarVin()
    {
        return $this->CarVin;
    }

    /**
     * @param mixed $CarVin
     */
    public function setCarVin($CarVin)
    {
        $this->CarVin = $CarVin;
    }

    /**
     * @return mixed
     */
    public function getCarReg()
    {
        return $this->CarReg;
    }

    /**
     * @param mixed $CarReg
     */
    public function setCarReg($CarReg)
    {
        $this->CarReg = $CarReg;
    }

    /**
     * @return mixed
     */
    public function getCarPrice()
    {
        return $this->CarPrice;
    }

    /**
     * @param mixed $CarPrice
     */
    public function setCarPrice($CarPrice)
    {
        $this->CarPrice = $CarPrice;
    }

    /**
     * @return mixed
     */
    public function getCarMake()
    {
        return $this->CarMake;
    }

    /**
     * @param mixed $CarMake
     */
    public function setCarMake($CarMake)
    {
        $this->CarMake = $CarMake;
    }

    /**
     * @return mixed
     */
    public function getCarColor()
    {
        return $this->CarColor;
    }

    /**
     * @param mixed $CarColor
     */
    public function setCarColor($CarColor)
    {
        $this->CarColor = $CarColor;
    }

    /**
     * @return mixed
     */
    public function getCarImage()
    {
        return $this->CarImage;
    }

    /**
     * @param mixed $CarImage
     */
    public function setCarImage($CarImage)
    {
        $this->CarImage = $CarImage;
    }

    /**
     * @return mixed
     */
    public function getCarModel()
    {
        return $this->CarModel;
    }

    /**
     * @param mixed $CarModel
     */
    public function setCarModel($CarModel)
    {
        $this->CarModel = $CarModel;
    }

    /**
     * @return mixed
     */
    public function getCarEngineSize()
    {
        return $this->CarEngineSize;
    }

    /**
     * @param mixed $CarEngineSize
     */
    public function setCarEngineSize($CarEngineSize)
    {
        $this->CarEngineSize = $CarEngineSize;
    }

    /**
     * @return mixed
     */
    public function getCarMileage()
    {
        return $this->CarMileage;
    }

    /**
     * @param mixed $CarMileage
     */
    public function setCarMileage($CarMileage)
    {
        $this->CarMileage = $CarMileage;
    }






}

