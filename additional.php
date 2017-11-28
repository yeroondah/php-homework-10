<?php

    //абстрактный суперкласс

    abstract class Product
    {
        public $title;
        public $price;
        
        public function getPrice()
        {
            return $this->price;
        }

        public function setPrice($price)
        {
            $this->price = $price;
            return $this;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function setTitle($title)
        {
            $this->title = $title;
            return $this;
        }

        abstract public function getDiscription();

    }

    // ниже, абстрактный класс с методом расчёта скидки

    abstract class Discount extends Product
    {
        public $discount = 10;
        public $discountExist = true;

        public function getDiscount()
        {
            return $this->discount;
        }

        public function setDiscount($discount)
        {
            $this->discount = $discount;
            return $this;
        }

        public function calcDiscount()
        {
            echo $equal = $this->price - $this->price*$this->discount/100;
        }

    }

    // ниже, абстрактный класс с методом расчёта стоимости доставки

    abstract class Delivery extends Discount
    {
        public function calcDelivery()
        {
            if($this->discountExist == true) {
                echo 300;
            } else {
                echo 250;
            }
        }
    }

    // Первый дочерний класс. Скидка 10%.

    class Car extends Delivery
    {
        public $color;
        public $engine;

        public function getColor()
        {
            return $this->color;
        }

        public function setColor($color)
        {
            $this->color = $color;
            return $this;
        }

        public function getEngine()
        {
            return $this->engine;
        }

        public function setEngine($engine)
        {
            $this->engine = $engine;
            return $this;
        }

        public function getDiscription()
        {       
                echo $this->getTitle() . '<br>';
                echo $this->getColor() . '<br>';
                echo $this->getEngine() . '<br>';
                echo $this->calcDiscount() . '<br>';
                echo $this->calcDelivery() . '<br>' . '<br>';
        }

    }

    // второй дочерний класс. Скидка 10%.

    class Snowboard extends Delivery
    {
        public $length;

        public function getLenght()
        {
            return $this->length;
        }

        public function setLength($length)
        {
            $this->length = $length;
            return $this;
        }

        public function getDiscription()
        {
                echo $this->getTitle() . '<br>';
                echo $this->getLenght() . '<br>';
                echo $this->calcDiscount() . '<br>';
                echo $this->calcDelivery() . '<br>' . '<br>';
        }
    }

    // третий дочерний класс.Скидка 10% если стоимость товара будет выше 40000

    class AudioSystem extends Delivery
    {
        public $power;

        public function getPower()
        {
            return $this->power;
        }

        public function setPower($power)
        {
            $this->power = $power;
            return $this;
        }
        public function getDiscription()
        {
                echo $this->getTitle() . '<br>';
                echo $this->getPower() . '<br>';
                echo $this->calcDiscount() . '<br>';
                echo $this->calcDelivery() . '<br>' . '<br>';
        }

        // ниже, расширение метода

        public function calcDiscount()
        {
            if($this->price > 40000) {
                echo $equal = $this->price - $this->price*$this->discount/100;
                $this->discountExist = true;
            } else {
                echo $this->price;
                $this->discountExist = false;
            }
        }
    }

    $products = [
        (new Car())->setTitle('Audi')->setPrice(600000)->setColor('Silver')->setEngine(2.4),
        (new Snowboard())->setTitle('Forum')->setPrice(58000)->setLength(158),
        (new AudioSystem())->setTitle('Pioneer')->setPrice(41000)->setPower('40W'),
        (new AudioSystem())->setTitle('Microlab')->setPrice(12000)->setPower('16W')
    ];

    foreach($products as $product) {
        $product->getDiscription();
    }
    
?>