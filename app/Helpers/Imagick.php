<?php

if (!function_exists('imagick_svg_text')) {
    function imagick_svg_text($svg = "", $font = "NotoSansJP-Regular.otf")
    {
        /*
        $svg = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
        <svg height="24" width="200">
        <text x="0" y="22" font-size="24" font-weight="600" style="fill:black;">2022.12.01</text>
        </svg>
        ';
        */

        $image = new \Imagick();
        $image->setFont($font);
        $image->setTextEncoding('UTF-8');
        $image->readImageBlob($svg);
        $image->setImageFormat("png24");
        return base64_encode($image);
    }
}

if (!function_exists('imagick_simple_text')) {
    function imagick_simple_text($sentence)
    {
        /* Create some objects */
        $image = new \Imagick();
        $draw = new \ImagickDraw();
        $draw->setFillColor('black');
        $draw->setStrokeAntialias(true);
        $draw->setTextAntialias(true);
        $draw->setFontSize(24);
        $text=$sentence;
        // Set typeface
        $draw->setFont('NotoSansJP-Medium.otf');
        // Calculate size
        $metrics = $image->queryFontMetrics($draw,$text,FALSE);
        $w=$metrics['textWidth'];
        $h=$metrics['textHeight'];
        $y=$metrics['ascender'];
        $image->newImage($w,$h,"transparent","png");
        $image->annotateImage($draw,0,$y,0,$text);
        // $image->writeImage("result.png");

        return $mydate = base64_encode($image);
    }
}

if (!function_exists('imagick_code_128')) {
    function imagick_code_128($sentence)
    {

        $barcode=$sentence;//'7039560000390';
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();


        $barCodeImg = $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 3, 120);

        $imagick = new \Imagick();
        $imagick->readImageBlob($barCodeImg);
        $imagick->setImageBackgroundColor('white');

        # Make room for text
        $imagick->extentImage($imagick->getImageWidth()+25,$imagick->getImageHeight()+15,-25,0);

        # Draw barcode numbers on image
        $draw = new \ImagickDraw();
        $draw->setStrokeWidth(1);
        $draw->setFillColor('black');
        // $draw->setFont('Noto-Mono');
        $draw->setFont('NotoSansJP-Regular.otf');
        $draw->setTextUnderColor('white');
        $draw->setFontSize(28);
        // $draw->rectangle(200, 200, 300, 300);
        // $draw->setTextInterLineSpacing(40);

        preg_match('/^(\d)(\d{6})(\d{6})$/',$barcode,$parts);
        // EAN_13
        /*
        $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
        $imagick->annotateImage($draw, 35, 135, 0, $parts['2']);
        $imagick->annotateImage($draw, 174, 135, 0, $parts['3']);
        $imagick->resetIterator();
        $imagick = $imagick->appendImages(true);
        */

        try {
            $fillColor = new \ImagickPixel("White");
            $draw->setFillColor($fillColor);
            $draw->rectangle(200, 210, 50, 102);
            $imagick->drawImage($draw);

            $fillColor = new \ImagickPixel("White");
            $draw->setFillColor($fillColor);
            $draw->rectangle(220, 210, 370, 102);
            $imagick->drawImage($draw);

            $fillColor = new \ImagickPixel("Black");
            $draw->setFillColor($fillColor);

            // $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
            // $imagick->annotateImage($draw, 35, 135-10, 0, $parts['2']);
            // $imagick->annotateImage($draw, 174, 135-10, 0, $parts['3']);
            // $imagick->resetIterator();
            // $imagick = $imagick->appendImages(true);

            $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
            $imagick->annotateImage($draw, 75, 135, 0, $parts['2']);
            $imagick->annotateImage($draw, 247, 135, 0, $parts['3']);
            $imagick->resetIterator();
        } catch (Exception ) {
        }

        $imagick->setImageFormat("png");
        // // $barCodeImg = $imagick->getImageBlob();

        return base64_encode($imagick);
    }
}

if (!function_exists('imagick_code_128_鉄筋')) {
    function imagick_code_128_鉄筋($sentence)
    {

        $barcode=$sentence;//'7039560000390';
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();


        $barCodeImg = $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 3, 200); // 120 default

        $imagick = new \Imagick();
        $imagick->readImageBlob($barCodeImg);
        $imagick->setImageBackgroundColor('white');

        # Make room for text
        $imagick->extentImage($imagick->getImageWidth()+25,$imagick->getImageHeight()+15,-25,0);

        # Draw barcode numbers on image
        $draw = new \ImagickDraw();
        $draw->setStrokeWidth(1);
        $draw->setFillColor('black');
        // $draw->setFont('Noto-Mono');
        $draw->setFont('NotoSansJP-Regular.otf');
        $draw->setTextUnderColor('white');
        $draw->setFontSize(28);
        // $draw->rectangle(200, 200, 300, 300);
        // $draw->setTextInterLineSpacing(40);

        preg_match('/^(\d)(\d{6})(\d{6})$/',$barcode,$parts);
        // EAN_13
        /*
        $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
        $imagick->annotateImage($draw, 35, 135, 0, $parts['2']);
        $imagick->annotateImage($draw, 174, 135, 0, $parts['3']);
        $imagick->resetIterator();
        $imagick = $imagick->appendImages(true);
        */

        try {
            $fillColor = new \ImagickPixel("White");
            $draw->setFillColor($fillColor);
            $draw->rectangle(200, 210, 50, 160);
            $imagick->drawImage($draw);

            $fillColor = new \ImagickPixel("White");
            $draw->setFillColor($fillColor);
            $draw->rectangle(220, 210, 370, 160);
            $imagick->drawImage($draw);

            $fillColor = new \ImagickPixel("Black");
            $draw->setFillColor($fillColor);

            // $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
            // $imagick->annotateImage($draw, 35, 135-10, 0, $parts['2']);
            // $imagick->annotateImage($draw, 174, 135-10, 0, $parts['3']);
            // $imagick->resetIterator();
            // $imagick = $imagick->appendImages(true);

            $imagick->annotateImage($draw, 0, 195, 0, $parts['1']);
            $imagick->annotateImage($draw, 75, 195, 0, $parts['2']);
            $imagick->annotateImage($draw, 247, 195, 0, $parts['3']);
            $imagick->resetIterator();
        } catch (Exception ) {
        }

        $imagick->setImageFormat("png");
        // // $barCodeImg = $imagick->getImageBlob();

        return base64_encode($imagick);
    }
}

if (!function_exists('imagick_code_128_common')) {
    function imagick_code_128_common($sentence)
    {

        $barcode=$sentence;//'7039560000390';
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();


        $barCodeImg = $generator->getBarcode($barcode, $generator::TYPE_CODE_128, 3, 200); // 120 default

        $imagick = new \Imagick();
        $imagick->readImageBlob($barCodeImg);
        $imagick->setImageBackgroundColor('white');

        # Make room for text
        $imagick->extentImage($imagick->getImageWidth()+25,$imagick->getImageHeight()+15,-25,0);

        # Draw barcode numbers on image
        $draw = new \ImagickDraw();
        $draw->setStrokeWidth(1);
        $draw->setFillColor('black');
        // $draw->setFont('Noto-Mono');
        $draw->setFont('NotoSansJP-Regular.otf');
        $draw->setTextUnderColor('white');
        $draw->setFontSize(28);
        // $draw->rectangle(200, 200, 300, 300);
        // $draw->setTextInterLineSpacing(40);

        preg_match('/^(\d)(\d{6})(\d{6})$/',$barcode,$parts);
        // EAN_13
        /*
        $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
        $imagick->annotateImage($draw, 35, 135, 0, $parts['2']);
        $imagick->annotateImage($draw, 174, 135, 0, $parts['3']);
        $imagick->resetIterator();
        $imagick = $imagick->appendImages(true);
        */

        try {
            $fillColor = new \ImagickPixel("White");
            $draw->setFillColor($fillColor);
            $draw->rectangle(200, 210, 50, 160);
            $imagick->drawImage($draw);

            $fillColor = new \ImagickPixel("White");
            $draw->setFillColor($fillColor);
            $draw->rectangle(220, 210, 370, 160);
            $imagick->drawImage($draw);

            $fillColor = new \ImagickPixel("Black");
            $draw->setFillColor($fillColor);

            // $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
            // $imagick->annotateImage($draw, 35, 135-10, 0, $parts['2']);
            // $imagick->annotateImage($draw, 174, 135-10, 0, $parts['3']);
            // $imagick->resetIterator();
            // $imagick = $imagick->appendImages(true);

            $imagick->annotateImage($draw, 0, 195, 0, $parts['1']);
            $imagick->annotateImage($draw, 75, 195, 0, $parts['2']);
            $imagick->annotateImage($draw, 247, 195, 0, $parts['3']);
            $imagick->resetIterator();
        } catch (Exception ) {
        }

        $imagick->setImageFormat("png");
        // // $barCodeImg = $imagick->getImageBlob();

        return base64_encode($imagick);
    }
}
