## What is logger-for-php
Logger for PHP is a simple configurable class adding modern logging capabilities to your PHP code.

Latest version: 1.2

## How do I get set up?
Just add it to your project and import the Logger class into your php code and create a new instance

```
require_once 'logger-for-php/Logger.php';

$logger = new Logger();

```

### Logger configuration
Logger class instances come with a default configuration but you can and should use you own.
Like in modern logging systems you can set you own
 * Log level (by default is LogLevel::ALL)
 * log file path ( by default is $_SERVER['DOCUMENT_ROOT'] . "log/" )
 * a prefix for your log file (by defaut is 'log')
 
In order to issue a new configuration you can create a new instance of the LoggerConfig class and pass it to the Logger constructor, e.g.:
```
$config = new LoggerConfig();
$config->logLevel = LogLevel::ERROR;
$config->logFilePath = $_SERVER['DOCUMENT_ROOT'] . "my_app_folder/log/";
$config->logNamePrefix = "myAppLog";

$logger = new Logger($config);
``` 

You can vary Logger configuration at any time by calling the 'updateConfiguration' method in the Logger object, like this
```
$logger->updateConfiguration($config);
```

### Log Levels
So far supported log levels are
 * ALL
 * TRACE
 * DEBUG
 * INFO
 * WARN
 * ERROR
 * FATAL
 * OFF (switch off logging)

## Logging events ##
Once you have your Logger instance, you can easily start logging events inside your php code by calling the method matching the priority level of your event and passing in:
 * a 'tag' identifying the scope of the event (e.g. the PHP class generating the event or whatever you want)
 * the 'text' of the message you want to log
 
 e.g.
```
$logger->debug("Home page", "Web app started!!!");


$logger->error("Login", "An exception occurred: " . $ex->getMessage());
``` 

### Log file
Based on the examples shown above the log file will be called myAppLog_2020-02-02.log and will look line this:
```
D/Home page [ 02/Feb/20 15:09:41 ]: Web app started!!!
E/Login [ 02/Feb/20 15:10:35 ]: An exception occurred: Invalid credentials provided.
```

## Contribution guidelines ##

You can contribute to the project by:

* Reporting issues
* Writing tests
* Proposing missing features
* Issuing pull requests

## Who do I talk to? ##

Project owner:
Paolo Montalto - <p.montalto@xabaras.it>