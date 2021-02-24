<?php

/**
 * for the template pattern we are going to add an abstract class and this class is going to have all COMMON methods
 * subclasses use.
 */
abstract class Sub {
    public function make()
    {
        return $this
            ->layBread()
            ->addLettuce()
            ->addSauces()
            ->addPrimaryToppings();
    }
    protected function layBread()
    {
        var_dump('laying down the bread');

        return $this;
    }

    protected function addLettuce()
    {
        var_dump('add some lettuce');

        return $this;
    }
    protected function addSauces()
    {
        var_dump('add some sauce');

        return $this;
    }

    /**
     * by generalizing this name and differing it to an abstract method you give your template method control of
     * actually triggering methods but is not responsible for defining their behavior.
     */
    protected abstract function addPrimaryToppings();
}

/**
 * Subclasses classes will be extending abstract class containing common methods to needed.
 */
class TurkeySub extends Sub {

    public function addPrimaryToppings()
    {
        var_dump('add some turkey');

        return $this;
    }
}

class VeggieSub extends Sub{

    public function addPrimaryToppings()
    {
        var_dump('add some veggies');

        return $this;
    }
}