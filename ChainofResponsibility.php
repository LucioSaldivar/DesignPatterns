<?php
/**
 * We will make a base class to inherit from.
 */
abstract class HomeChecker {
    protected $successor;

    public abstract function check(HomeStatus $home);

    /**
     * this is the successor, the next object in the chain that we should call.
     */
    public function succeedWith(HomeChecker $successor)
    {
        $this->successor = $successor;
    }

    /**
     * this method will allow you to call the next object in the chain.
     */
    public function next(HomeStatus $home)
    {
        if ($this->successor)
        {
            $this->successor->check($home);
        }
    }
}

/**
 * create classes that will become subclasses.
 */
class Locks extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->locked)
        {
            throw new Exception('The doors are not locked!!');
        }

        $this->next($home);
    }
}

class Lights extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->lightsOff)
        {
            throw new Exception('The lights are still on!!');
        }

        $this->next($home);
    }
}

class Alarm extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->alarmOn)
        {
            throw new Exception('The alarm has not been set!!');
        }

        $this->next($home);
    }
}

/**
 * This part doesn't have to be hardCoded it can come from a Form or a Database Result Set
 */
class HomeStatus {
    public $alarmOn = true;
    public $locked = true;
    public $lightsOff = true;
}

/**
 * Set up objects, think of this as different ways we can handle request.
 * Any of these objects has the ability to slice through the chain so that nothing else gets triggered.
 */
$locks = new Locks;
$lights = new Lights;
$alarm = new Alarm;

/**
 * this is how the chain is created
 */
$locks->succeedWith($lights);
$locks->succeedWith($alarm);

/**
 * to set it in motion
 */
$locks->check(new HomeStatus);