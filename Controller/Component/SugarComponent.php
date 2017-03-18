<?php

App::uses('Component', 'Controller');

class SugarComponent extends Component {

    public function initialize(Controller $controller) {
        $this->Controller = $controller;
    }


    public function loadService($service){
       
        $serviceClass = $service.'Service';
        App::import('Controller/Service', $serviceClass);
	    $this->Controller->$serviceClass = new $serviceClass($this->Controller);
    }
    public function loadRepo($repo){
        $repoClass = $repo.'Repository';
        $repoName = $repo.'Repo';
        App::import('Model/Repository', $repoClass);
 
	    $this->Controller->$repoName = new $repoClass();
    
     }
}