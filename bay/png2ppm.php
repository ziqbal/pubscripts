<?php

foreach (glob("/home/zaf/tmp/mandel/*.png") as $filename) {
    $p1=pathinfo($filename);

    process($filename);

 //   print_r($p1);
    $target="/home/zaf/tmp/mandelppm/".$p1['filename'].".ppm";
    $cmd="convert out.png $target";
    print("$cmd\n");
    system($cmd);
}



function process($path){
    // Quarter frame window crop resize
    $w1=800;
    $h1=600;

    $im1=imagecreatefromstring(file_get_contents($path));

    $w2=imagesx($im1);
    $h2=imagesy($im1);

    $w3=$w1/2;
    $h3=$h1/2;

    $w4=$w2;
    $h4=$w4*($h3/$w3);

    if($h4>$h2){
        $h4=$h2;
        $w4=$h4*($w3/$h3);
    }

    $x4=($w2-$w4)/2;
    $y4=($h2-$h4)/2;

    print("$w1,$h1 -> $w4,$h4 $x4,$y4\n");

    $im2=imagecreatetruecolor($w3, $h3);

    imagecopyresampled($im2, $im1, 0, 0, $x4, $y4, $w3, $h3, $w4, $h4);
    imagepng($im2, "out.png");

    imagedestroy($im1);
    imagedestroy($im2);
}
