<?php

class SuperAppService {
    public $Controller = null;

     public function __construct(Controller $controller) {
       
        $this->Controller = $controller;
    }

    protected function loadRepo($repo){
     
        $repoClass = $repo.'Repository';
        $repoName = $repo.'Repo';
        App::import('Model/Repository', $repoClass);
 
	    $this->$repoName = new $repoClass();
    
    }

    protected function loadService($service){
        $serviceClass = $service.'Service';
        App::import('Controller/Service', $serviceClass);
	    $this->$serviceClass = new $serviceClass($this->Controller);

    }
}