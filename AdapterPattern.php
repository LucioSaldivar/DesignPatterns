<?php
/**
 * Start the Adapter Pattern with a contract(interface)
 */
interface BookInterface {
    public function open();

    public function turnPage();
}

interface eReaderInterface{
    public function turnOn();

    public function pressNextButton();
}

/**
 * Create a class to adhere the contract (interface)
 */
class Book implements BookInterface {
    public function open()
    {
        var_dump('opening the paper book.');
    }

    public function turnPage()
    {
        var_dump('turning the page of the paper book.');
    }
}

class Kindle implements eReaderInterface{
    public function turnOn()
    {
        var_dump('turn the Kindle on');
    }

    public function pressNextButton()
    {
        var_dump('press the next button on the Kindle');
    }
}

/**
 * for our person class to be able to use the kindle class we will need to build our adapter.
 * make sure to implement the interface you are trying to adapt too.
 */
class KindleAdapter implements BookInterface {
    /**
     * you will need to inject the class of adapter
     */
    private  $kindle;

    public function __construct(Kindle $kindle)
    {
        $this->kindle = $kindle;
    }

    /**
     * translate the original interfaces methods over to the new one.
     */
    public function open()
    {
        return $this->kindle->turnOn();
    }

    public function turnPage()
    {
        return $this->kindle->pressNextButton();
    }
}

/**
 * the Person class would be referred as the client code (Index or Main).
 */
class Person {
    /**
     * instead of hoping $book adheres to our contract or locking it to a specific concrete implementation.
     * instead tell it that you need SOME kind of implementation of contract. so type in interface this decouples code.
     */
    public function read(BookInterface $book)
    {
        $book->open();

        $book->turnPage();
    }
}

(new Person)->read(new Book);
(new Person)->read(new KindleAdapter(new Kindle));