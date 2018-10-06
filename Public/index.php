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
        //$fileArray[];



        while(! feof($openFile))
        {

            /*$object = (object) $openFile;
            foreach ($openFile as $key => $value)
            {
                $object->$key = $value;
            }*/

            print_r(fgetcsv($openFile));
            /*echo "</br>";
            print_r($object);*/

        }
        fclose($openFile);

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






