<?php
function create($name) {
    if (!file_exists($name)) {
        if (($name !=='') && (strpbrk($name, "\/?%*:|\"<>")=== FALSE)) {
            $extension=strrchr($name,'.');
            if ($extension == '.txt') {
                $handle = fopen($name,'w'); 
                fclose($handle);
            } else {
                mkdir($name);
            }
        } else {
            echo "Mauvais nom de fichier/dossier";
        }
    } else {
        echo "Nom déjà existant";
    }
}

function taille_dossier($rep){
    $racine = opendir($rep);
    $taille = 0;
    while($dossier = readdir($racine)){
        if (!in_array($dossier, array("..", "."))){
            if(is_dir($rep.DIRECTORY_SEPARATOR.$dossier)){
                $taille+=taille_dossier($rep. DIRECTORY_SEPARATOR .$dossier);
            }else{
                $taille+= filesize($rep. DIRECTORY_SEPARATOR .$dossier);
            }
        }  
    }
    closedir($racine);
    return $taille;
}

function afficher_content($name) {
    $lines = file("./$name"); // display file line by line 
    foreach($lines as $line_num => $line) { 
        echo "# {$line_num} : ".htmlspecialchars($line)."<br />\n"; 
    }
}
function rrmdir($dir) { 
    if (is_dir($dir)) { 
      $objects = scandir($dir);
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") { 
          if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object)) {
            rrmdir($dir. DIRECTORY_SEPARATOR .$object);
          }else {
            unlink($dir. DIRECTORY_SEPARATOR .$object); 
          }
        } 
      }
      rmdir($dir); 
    } 
  }