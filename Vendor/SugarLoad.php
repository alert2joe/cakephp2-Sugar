<?php
Class SugarLoad{
     public static $item = array();

     public static function load($path){
         
            $mainPath = 'Domain';
            $path = $mainPath.'/'.$path;
            $paths = explode('/',$path);
            $className = array_pop($paths);
            if(isset(self::$item[$path])==false){
        
                include_once(APP.implode('/',$paths).'/'.$className.'.php');
            }

     }

      public static function get($repoPath){
            $mainPath = 'Domain';
            $repoPath = $mainPath.'/'.$repoPath;
            $repoPaths = explode('/',$repoPath);
            $className = array_pop($repoPaths);
            if(isset(self::$item[$repoPath])){
                return self::$item[$repoPath];
            }else{
                include_once(APP.implode('/',$repoPaths).'/'.$className.'.php');
            }
            $namespaceClass = implode('\\',$repoPaths).'\\'.$className;
            $out = new $namespaceClass();
            self::$item[$repoPath] = $out;
            return $out;
     }

    function Repo($repoPath){
            $mainPath = 'Domain/Repository';
            $repoPath = $mainPath.'/'.$repoPath;
            $repoPaths = explode('/',$repoPath);
            $className = array_pop($repoPaths);
            App::import(implode('//',$repoPaths), $className);
            $namespaceClass = implode('\\',$repoPaths).'\\'.$className;
            return new $namespaceClass();
        }

    function Service($repoPath){
            
            $mainPath = 'Domain/Service';
            $repoPath = $mainPath.'/'.$repoPath;
            $repoPaths = explode('/',$repoPath);
            $className = array_pop($repoPaths);
    
            App::import(implode('//',$repoPaths), $className);
            $namespaceClass = implode('\\',$repoPaths).'\\'.$className;
            $out =new $namespaceClass();
            $item[$repoPath] = $out;
            return $out;
        }

        function Model($modelClass,$id=null){
          
                list($plugin, $modelClass) = pluginSplit($modelClass, true);

                $c = ClassRegistry::init(array(
			'class' => $plugin . $modelClass, 'alias' => $modelClass, 'id' => $id
		));
                if (!$c) {
                    throw new MissingModelException($modelClass);
                }
                return $c;
        }
        function QueryObj(){
            App::import('Model/Query', 'QueryObject');
            return new QueryObject(); 
        }
        function formatObj($data){
          App::import('Model/Format', 'FormatObject');
          return new FormatObject($data); 
        }

}
