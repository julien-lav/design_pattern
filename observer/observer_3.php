<?php

/* Interface */
/*
interface SplSubject {
	public function attach(SplObserver $observer);
	public function detach(SplObserver $observer);
	public function notify();

}
interface SplObserver {
	public function update();
}
*/
/*
class SplObjectStorage() {
	private $storage;

	public function __construct($storage){

	} 
}
*/

/* Simple class */
class Article 
{
	private $title;

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}
}

class ArticleManager implements SplSubject
{
	private $article;
	protected $observers;

	public function __construct()
	{
		$this->observers = new SplObjectStorage();
	}

	public function attach(SplObserver $observer)
	{
		$this->observers->attach($observer);
	}

	public function detach (SplObserver $observer) 
	{	
		$this->observers->detach($observer);
	}

	public function notify()
	{
		foreach($this->observers as $observer) {
			$observer->update($this);
		}
	}

	public function create(Article $article) 
	{
		$this->article = $article;
		$this->notify();
	}

	public function getArticle()
	{
		return $this->article;
	}
} 

class Notify implements SplObserver
{
	public function update(SplSubject $subject)
	{
		 echo("La classe Notify a été alerté. L'article '" . $subject->getArticle()->getTitle() . "' a été crée.\n");	
	}
}

class SearchEngine implements SplObserver
{
	public function update(SplSubject $subject)
    {
        echo("La classe SearchEngine a été alerté. L'article '" . $subject->getArticle()->getTitle() . "' a été crée.\n <br />");
    }
}

$notify = new Notify();
$searchEngine = new SearchEngine();

$articleManager = new ArticleManager();
$articleManager->attach($notify);
$articleManager->attach($searchEngine);

$article = new Article();
$article->setTitle('Titre de l\'article n°1');

$article_2 = new Article();
$article_2->setTitle('Titre de l\'article n°2');


$articleManager->create($article);
$articleManager->create($article_2);