<?php
	session_start();
	$code=rand(100000,999999);
	$_SESSION['code']=$code;

	$Image=imagecreate(110,40);
        
        // sets background to red
        $red = imagecolorallocate($Image, 255, 255, 255);
        imagefill($Image, 0, 0, $red);
        
        $result=imagecreate(110,40);
	settype($code,'string');

        for ($i = 0; $i < 4; $i++) {
            imageLine($Image,
                    rand(0,54),
                    rand(0,19),
                    rand(0,54),
                    rand(0,19),
                    imagecolorAllocate(
                            $Image,
                            rand(120,254),
                            rand(140,165),
                            rand(185,250)
                    )
             );
        };


        for ($i = 0; $i < strlen($code); $i++) {
            imageString($Image, 5, 5+8*$i, rand(3,6), $code[$i],
                    imagecolorAllocate(
                            $Image,
                            rand(50,254),
                            rand(100,165),
                            rand(65,250)
                    )
             );
        };
        
        Header('Content-type: image/png');
        imagecopyresampled($result,$Image,0,0,0,0,110,40,55,20);
	imagePng($result);
        imageDestroy($Image);
        imageDestroy($result);

