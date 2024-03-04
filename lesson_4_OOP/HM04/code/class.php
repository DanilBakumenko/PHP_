<?php

abstract class Book
{
    protected string $author;
    protected string $name;
    protected string $date;
    protected int $pagesCount;
    protected int $readers = 0;

    public function __construct(string $author, string $name, string $date, int $pagesCount)
    {
        $this->author = $author;
        $this->name = $name;
        $this->date = $date;
        $this->pagesCount = $pagesCount;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    public function getInfo(): string
    {
        return $this->getName() . ", " . $this->getAuthor() . PHP_EOL;
    }

    public function getBook(): void
    {
        $this->readers++;
    }
}

class Bookshelf
{
    protected array $author = [[]];

    public function __construct(array $books)
    {
        foreach ($books as $book) {
            $this->setBooks($book);
        }

    }

    public function getBooks(): array
    {
        return $this->author;
    }

    public function setBooks(PBook $book): void
    {
        if (array_key_exists(strtolower($book->getAuthor()[0]), $this->author)) {
            $this->author[strtolower($book->getAuthor()[0])][] = $book;
            $book->returnBook();
        } elseif (array_key_first($this->author) === 0) {
            $this->author = [strtolower($book->getAuthor()[0]) => [$book]];
            $book->returnBook();
        } else {
            $this->author += [strtolower($book->getAuthor()[0]) => [$book]];
            $book->returnBook();
        }
    }

    public function findBook(string $name): bool
    {
        foreach ($this->author as $books) {
            foreach ($books as $book) {
                if ($book->getName() == $name) {
                    return true;
                }
            }
        }
        return false;
    }

}

class EBook extends Book
{
    protected string $url;

    public function __construct(string $author, string $name, string $date, int $pagesCount, string $url)
    {
        parent::__construct($author, $name, $date, $pagesCount);
        $this->url = $url;
    }

    public function getUrl(): string
    {
        $this->readers++;
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}

class PBook extends Book
{
    protected string $libAddress;
    protected bool $read = false;

    public function __construct(string $author, string $name, string $date, int $pagesCount, string $address)
    {
        parent::__construct($author, $name, $date, $pagesCount);
        $this->libAddress = $address;
    }

    public function takeBook(): void
    {
        if (!$this->read) {
            $this->readers++;
            $this->read = true;
        }
    }

    public function returnBook(): void
    {
        $this->read = false;
    }

}

$book = new PBook("i am", "pupa", "12.12.2023", 34,"mira st. 75");
$book4 = new PBook("i am2", "pupa", "12.12.2023", 34,"mira st. 75");
$book1 = new PBook("am2", "pupa2", "12.12.2023", 34,"mira st. 75");
$book2 = new PBook("zam3", "pupa3", "12.12.2023", 34,"mira st. 75");
$book3 = new PBook("ri am4", "pupa4", "12.12.2023", 34,"mira st. 75");

//$arr = [$book];
$arr = [$book, $book1, $book2, $book3, $book4];
$shelf = new Bookshelf($arr);

//var_dump($shelf->getBooks());
//var_dump($shelf->findBook("pupa1"));
