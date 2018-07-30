<?php

class Hamburger
{
	public function constituer()
	{
		echo 'Magnificent burger <br />';
	}
	public function sauce()
	{
		echo 'Tomate/salad <br />';
	}
	public function methode_non_adapte()
	{
		echo 'Toujours plus ! <br />';
	}

}

interface BuildableInterface 
{
	public function build();
	public function condiment();
}

class HotDog implements BuildableInterface
{
	public function build()
	{
		echo 'Great hotdog !!! <br />';
	}
	public function condiment()
	{
		echo "Saussice/oignon !! <br />";
	}
	public function methode_non_adapte()
	{
		echo 'Toujours plus ! <br /><br />';
	}

}


class AdapterHamburger implements BuildableInterface
{
    private $_hamburger = null;

    public function __construct(Hamburger $p_hamburger)
    {
        $this->_hamburger = $p_hamburger;
    }
    public function build()
    {
    	$this->_hamburger->constituer();
    }
    public function condiment()
    {
    	$this->_hamburger->sauce();
    }
    public function methode_non_adapte()
	{
		echo 'Toujours plus ! <br /><br />';
	}

}

/*
$aOrder = array(new Hamburger(), new HotDog());

foreach ($aOrder AS $oProduct)
{
        $oProduct->build(); *//* CRASH ! *//*

}
*/

$aOrder = array(new AdapterHamburger(new Hamburger()), new HotDog());

foreach ($aOrder AS $oProduct)
{
        $oProduct->build(); /* Miam miam */
        $oProduct->condiment(); /* Miam miam */
        $oProduct->methode_non_adapte(); /* Miam miam */
}