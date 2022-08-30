<?php

// first class
class Animal
{
    function eat()
    {
        echo "Animal can eat.";
        echo "<br/>";
    }
    function sleep()
    {
        echo "Animal can sleep";
        echo "<br/>";
    }
}

class Monkey extends Animal
{
    function jump()
    {
        echo "can jump.";
        echo "<br/>";
    }
    private function bite()
    {
        echo "can bite";

    }
}

class Human extends Monkey
{
    function eat()
    {
        echo "Human can eat.";
        echo "<br/>";
    }
    function sleep()
    {
        echo "Human can sleep";
        echo "<br/>";
    }
}

$anik = new Human();
$anik->jump();

$animal = new Human();
$animal->eat();

// second class
abstract class MO
{
    public $id, $name, $salary, $basicPay;
    abstract function salary();

}

class HMO extends MO
{
    public $overTimeAllowance;
    function __construct($basicPay, $overTimeAllowance)
    {
        $this->basicPay = $basicPay;
        $this->overTimeAllowance = $overTimeAllowance;
    }
    function salary()
    {
        $this->salary = $this->basicPay + $this->overTimeAllowance;
        return $this->salary;
    }
}

class IMO extends MO
{
    public $medicalAllowance, $houseRent;
    function __construct($basicPay, $overTimeAllowance)
    {
        $this->basicPay = $basicPay;
        $this->overTimeAllowance = $overTimeAllowance;
    }
    function salary()
    {
        $this->salary = $this->basicPay + $this->overTimeAllowance;
        return $this->salary;
    }
}

$hom = new HMO(10, 5);
$ho = new HMO(10, 1);

echo $hom->salary();
echo "<br/>";
echo $ho->salary();


// third class

class A{
    protected $a;

    protected function get_a(){
       return $this->a;
    }
}

class B extends A{
    function __construct($a){
        $this->a = $a;
    }
}

class C extends B{
    function __construct(){
        $this->a = "From C";
    }
}

$c = new C();
echo $c->get_a();


// forth class

class MY{
    const MY_ALERT = "VERY BAD";    
}

echo MY:: MY_ALERT;



?>