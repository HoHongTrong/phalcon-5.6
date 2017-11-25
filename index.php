<?php
define('APPLICATION_PATH',__DIR__);
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
echo APPLICATION_PATH;
  try
  {
    //loader
      $loader = new \Phalcon\Loader();

    //dependency injection
      $di = new FactoryDefault();
      $di->set('router',function (){
        $router = new Router();
        $router->setDefaultModule('hello');
        $router->handle();
        return $router;
      });

    //application
      $application = new Application($di);
      $application->registerModules([
        'hello'=>[
          'className'=>'Multiphalcon\Hello\Module',
          'path'    => APPLICATION_PATH.'/hello/Module.php'
        ]
      ]);
      echo $application->handle()->getContent();
  }
  catch(\Exception $e)
  {
    echo $e->getMessage();
  }
?>