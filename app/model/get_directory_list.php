<?php

    function get_directory_list($dir){
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
        
        return array(
            'dirs' => $dirs,
            'files' => $files
        );
    };