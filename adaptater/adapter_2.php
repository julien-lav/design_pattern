<?php

interface BookInterface
{
	public function open();
	public function turnpage();
	public function getPage(): int;
}

interface EbookInterface
{
	public function unlock();
	public function pressNext();
	public function getPage(): array;

}

class Book implements BookInterface
{
	private $page;

	public function open()
	{
		$this->page = 1;
	}
	public function turnPage()
    {
        $this->page++;
    }
    public function getPage(): int
    {
    	return $this->page;
    }
}

class EBook implements EbookInterface
{
	private $page = 1;
    private $totalPages =100;
    
    public function unlock()
    {      
    }

    public function pressNext()
    {
        $this->page++;
    }

	public function getPage(): array
    {
   	return [$this->page, $this->totalPages];
    }
} 

class EBookAdapter implements BookInterface
{

	private $eBook;

    public function __construct(EbookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function open()
    {
    	$this->eBook->unlock();
    }

    public function turnPage()
    {
    	$this->eBook->pressNext();
    }

	public function getPage(): int
	{
		return $this->eBook->getPage()[0];
	}  
}

/*
public function update(Bookinterface $book)
{
	// Traitement
} 
*/

$book = new Book();
//updateBook($book);

$eBookAdapter = new EBookAdapter(new EBook());
//updateBook($eBookAdapter);
