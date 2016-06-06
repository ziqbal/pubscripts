<?php

foreach (glob("/home/zaf/tmp/caravan1/*.png") as $filename) {
    $p1=pathinfo($filename);

    $target="/home/zaf/tmp/caravan1jpg/".$p1['filename'].".jpg";

 //   print_r($p1);

    $cmd="convert -thumbnail 400 -quality 90 -modulate 120,10,100 -colorize 20 -gamma 0.5 -contrast $filename $target";
    print("$cmd\n");
    system($cmd);
}



