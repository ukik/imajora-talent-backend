<?php
if (!function_exists('imagick_text')) {
    function imagick_text($sentence)
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
        $draw->setFont('NotoSansJP-Black.otf');
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

if (!function_exists('code_128')) {
    function code_128($sentence)
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
        $draw->setFont('Noto-Mono');
        $draw->setTextUnderColor('white');
        $draw->setFontSize(35);

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
            $imagick->annotateImage($draw, 0, 135, 0, $parts['1']);
            $imagick->annotateImage($draw, 50, 135, 0, $parts['2']);
            $imagick->annotateImage($draw, 240, 135, 0, $parts['3']);
            $imagick->resetIterator();

        } catch (Exception ) {
        }

        $imagick->setImageFormat("png");
        // // $barCodeImg = $imagick->getImageBlob();

        return base64_encode($imagick);
    }
}

if (!function_exists('sorting')) {
    function sorting($sentence)
    {
        return $sentence ? 'desc' : 'asc';
    }
}

if (!function_exists('prepand_zero')) {
    function prepand_zero($number, $length = 4)
    {
        return sprintf("%0".$length."s", $number);
        // return sprintf("%04d", 999); // negative support
    }
}

if (!function_exists('make_slug')) {
    function make_slug($string) {
        $slug = preg_replace('/\s+/u', '-', trim(strtolower($string)));

        if(isset($slug)):
            return $slug;
        else:
            return preg_replace('/\s+/u', '-', trim($string));
        endif;
    }
}

if (!function_exists('TrimString')) {
    function TrimString($sentence)
    {
        return preg_replace('/\s/', '', $sentence);
    }
}

if (!function_exists('Jabatan')) {
    function Jabatan($variable)
    {
        $n = "";
        switch ($variable) {
            case '0':
                $n = "admin";
                break;
            case '1':
                $n = "supervisor";
                break;
            case '2':
                $n = "temperature man";
                break;
        }
        return strval($n);
    }
}

if (!function_exists('qcheckbox')) {
    function qcheckbox($value)
    {
        return empty($value) || !$value ? '0' : '1';
    }
}
