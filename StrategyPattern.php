<?php
/**
 * encapsulate and make algorithms interchangeable by implementing an interface.
 */
interface Logger {
    public function log($data);
}

/**
 * Define a family of algorithms
 */
class LogToFile implements Logger {
    public function log($data)
    {
        var_dump('Log to the data to a file');
    }
}
class LogToDatabase implements Logger {
    public function log($data)
    {
        var_dump('Log the data to the database');
    }
}
class LogToXWebService implements Logger {
    public function log($data)
    {
        var_dump('Log the data to the Saas site.');
    }
}

/**
 * this class is in charge of the context, where the strategy pattern as well as polymorphism come in on clutch.
 * make sure to call in your interface.
 */
class App {
    public function log($data, Logger $logger)
    {
        $logger->log($data);
    }
}

$app = new App;

$app->log('Some information here', new LogToXWebService);