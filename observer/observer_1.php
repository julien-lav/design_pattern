<?php


interface SubjectInterface {
	public function attach(ObserverInterface $observer);
	public function detach(ObserverInterface $observer);
	public function notify();
} 

interface ObserverInterface {
	public function update();
} 

class PersonnageInfluent implements SubjectInterface 
{

	private $_age;
	private $_observers;

	public function attach(ObserverInterface $observer)
	{
		 $this->_observers[] = $observer;
	}
	public function detach(ObserverInterface $observer)
	{
		$key = array_search($observer, $this->_observers);
			if($key){
			unset($this->_observers[$key]);
		}
	}
	public function notify()
	{
		foreach($this->_observers as $observer){
			$observer->update();
		}
	}
	public function changeAge($age)
	{
		$this->_age = $age;
		$this->notify();
	}
	public function getAge()
	{
		return $this->_age;
	}
}
  
class Fan implements ObserverInterface
{
	private $_subject;
 
 	public function update() {
 		echo 'Age changed ! ' . $this->_subject->getAge();
 	}

    public function __construct(SubjectInterface $subject)
    {
    	$this->_subject = $subject;
        $this->_subject->attach($this);
    }
}

// $array = ["un", 2,3,4,5,6];

$lerdorf = new PersonnageInfluent();
$ferrandez = new Fan($lerdorf);
$lerdorf->changeAge(36);
$lerdorf->detach($ferrandez);