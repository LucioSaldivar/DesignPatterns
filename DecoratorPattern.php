<?php
/**
 * Start the Decorator Pattern with a contract(interface)
 */
interface CarService {
    public function getCost();

    public function getDescription();
}

/**
 * Create a core class to adhere the contract (interface)
 */
class BasicInspection implements CarService {
    public function getCost()
    {
        return 25;
    }

    public function getDescription()
    {
        return 'Basic inspection';
    }
}

class OilChange implements CarService {
    /**
     * For the decorator you are going to inject contract
     */
    protected $carService;

    /**
     * Decorator must except an instance or an implementation of the same contract (interface).
     * This is what specifically allows us to build up objects at runtime.
     */
    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return 29 + $this->carService->getCost();
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ', and oil change';
    }
}

class TireRotation implements CarService {
    protected $carService;

    function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return 15 + $this->carService->getCost();
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ', and a tire rotation';
    }
}

/**
 * Wrap core service (BasicInspection) with any number of Decorators (OilChange)
 */
$service =new OilChange(new TireRotation(new BasicInspection));
echo $service->getDescription();

echo $service->getCost();

