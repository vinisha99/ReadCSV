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

        $openFile = fopen($fileName, "r");
        $newArray = array();
        $i=0;



        while(! feof($openFile))
        {

            $fileArray = fgetcsv($openFile);


            $objectFile = (object) $fileArray;
            /*foreach ($fileArray as $key => $value)
            {
                $objectFile->$key = $value;

                $newArray[$i] = $objectFile;
            }*/
            $newArray[$i] = $objectFile;
            $i++;



            //$fileArray = fgetcsv($openFile);

            //$fileRecords[] = fileActions::convertArrayToObject($fileArray);
            //print_r($fileArray);
            //echo "</br>";
            //$newArray = $objectFile;
            //print_r($objectFile);
            //print_r($newArray);
            //print_r($fileRecords);

        }
        fclose($openFile);
        print_r($newArray);


        /*foreach ($array as $key => $value)
        {
            $object->$key = $value;
        }*/

       /* $handle = fopen("test.csv", "r");
        for ($i = 0; $row = fgetcsv($handle ); ++$i) {
            // Do something will $row array
        }
        fclose($handle);*/


        echo 'file printed';



    }


}








