<?php
/**
 * Created by PhpStorm.
 * User: vinisha
 * Date: 10/4/18
 * Time: 2:52 PM
 */

//echo "hello world";

main::start("CSVFile.csv");

 class main{


    /**
     * @param $filename
     */
    static public function start($fileName){


        print_r(FileActions::readFile($fileName));

    }

}

class FileActions{

     static public function readFile($file)
     {
         $openFile = fopen($file, "r");
         $fileObjectData = array();
         $i = 0;

         while(! feof($openFile))
         {

             $fileArray = fgetcsv($openFile);
             $fileObject = self::convertToObject($fileArray);

             $fileObjectData[$i] = $fileObject;
             $i++;

         }
         fclose($openFile);
         //print_r($fileObjectData);
         return $fileObjectData;

     }

     static public function convertToObject($fileData)
     {
         $obFile = (object) $fileData;

         return $obFile;
     }
}








