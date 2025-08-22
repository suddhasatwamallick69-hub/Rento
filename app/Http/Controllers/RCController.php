<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Imagick;


class RCController extends Controller
{
    public function uploadRC(Request $request)
    {
        $request->validate([
            'registration_certificate' => 'required|image|mimes:jpeg,jpg|max:2048',
            // 'pollution_certificate' => 'required|image|mimes:jpeg,jpg|max:2048',
        ]);

        $imagePath = $request->file('registration_certificate')->store('rc_images', 'public');

        // echo $imagePath;
        // echo "<br>";


        // header('Content-type: image/jpg');

         // Create an Imagick object 
        //  $image = new Imagick(storage_path('app/public/' . $imagePath));

        //  // Use enhanceImage function 
        //  // $image->enhanceImage(); 
        //  $image->adaptiveSharpenImage(5,3);
        //  $image->brightnessContrastImage(20,10);
        //  // $image->contrastImage(true);
        //  $image->adaptiveResizeImage(2000, 1000);

        //  // Display the output image 
        //  $imageData = $image->getImageBlob();
        //  // Create and return a proper image response
        //  $response = Response::make($imageData);
        //  $response->header('Content-Type', $image->getImageMimeType());

        //  return $response;



        // Extract text from image
        $text = (new TesseractOCR(storage_path("app/public/" . $imagePath)))->run();

        // Extract dates from text
        $registrationDate = $this->extractDate($text, 'Date of Regn.');
        $validityDate = $this->extractDate($text, 'Regn. Validity*');

        echo $text;

        echo $registrationDate;
        echo $validityDate;

    }

    private function extractDate($text, $keyword)
    {
        preg_match('/' . $keyword . ':\s*(\d{2}\/\d{2}\/\d{4})/', $text, $matches);
        return $matches[1] ?? null;
    }
}