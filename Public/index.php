<?php
/**
 * Created by PhpStorm.
 * User: vinisha
 * Date: 10/4/18
 * Time: 2:52 PM
 */

//echo "hello world";
$fileName = "CSVFile.csv";
ProgramStart::main($fileName);

 class ProgramStart{


    /**
     * @param $filename
     */
    static public function main($fileName){

        $fileObjectData = FileActions::readFile($fileName);
        print_r($fileObjectData);

    }

}

class FileActions
{

    static public function readFile($file)
    {
        $openFile = fopen($file, "r");
        $i = 0;


        $fileFirstElement = array();

        while (!feof($openFile)) {

            $fileArray = fgetcsv($openFile);
            if ($i == 0)
                $fileFirstElement = $fileArray;
            else
                $fileObject[] = self::createKeyValuePair($fileFirstElement, $fileArray);

            $i++;
            //print_r($fileObject);

        }
        fclose($openFile);
        return $fileObject;


    }

    static public function createKeyValuePair(Array $keys, Array $values)
    {
        $keyValueArray = array_combine($keys, $values);
        $recordActions = new RecordActions($keyValueArray);
        return $recordActions;
    }
}

class RecordActions{
     public function __construct($keyValueArray)
     {
         foreach ($keyValueArray as $key => $value)
         {
             $this->createProperty($key, $value);
         }
     }

     public function createProperty($key, $value)
     {
         $this->{$key} = $value;
     }
}








