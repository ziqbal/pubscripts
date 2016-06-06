<?php

foreach (glob("/home/zaf/tmp/mandelppm/*.ppm") as $filename) {
    $p1=pathinfo($filename);


 //   print_r($p1);
    $target="/home/zaf/tmp/mandeljpg/".$p1['filename'].".jpg";
    $cmd="convert $filename $target";
    print("$cmd\n");
    system($cmd);
}



