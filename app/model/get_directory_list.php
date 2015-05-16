<?php

    function get_directory_list($dir,$like){
        $dirs = array();
        $files = array();
        // Open a directory, and read its contents
        if (is_dir($dir)){
          if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
                if (is_dir($dir.'/'.$file)) {
                    $dirs[count($dirs)] = $file;
                } else {
                    $files[count($files)] = $file;
                };
            };
            closedir($dh);
          };
        };
        sort($dirs);
        sort($files);
        
        if (isset($like)) {
            // ищем начинающиеся с 
            foreach ($dirs as $key => $value) {
                if (substr($value,0,strlen($like))!=$like) {
                    unset($dirs[$key]);
                };
            };
            $dirs = array_values($dirs);
            foreach ($files as $key => $value) {
                if (substr($value,0,strlen($like))!=$like) {
                    unset($files[$key]);
                };
            };
            $files= array_values($files);
        };
        
        return array(
            'dirs' => $dirs,
            'files' => $files
        );
    };