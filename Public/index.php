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
        //print_r($fileObjectData);
        tableActions::createTable($fileObjectData);

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

     public function convertToArray()
     {
         $array = (array) $this;
         return $array;
     }
}

class tableActions
{
    public static function createTable($fileObjectData)
    {
        $count = 0;

        HtmlActions::setTable(1);
        foreach ($fileObjectData as $arrayObjects) {
            $fieldArray = $arrayObjects->convertToArray();

            if($count == 0){
                $tableheading = self::readKeys($fieldArray);
                HtmlActions::readTHeading($tableheading);

                $tableRow = self::readValues($fieldArray);
                HtmlActions::generateTRows($tableRow);
            }
            else{
                $tableRow = self::readValues($fieldArray);
                HtmlActions::generateTRows($tableRow);
            }

            $count++;

        }

        HtmlActions::setTable(2);
    }

    static public function readKeys(Array $keyArray)
    {
        return(array_keys($keyArray));
    }

    static public function readValues(Array $valueArray)
    {
        return(array_values($valueArray));
    }
}

class HtmlActions
{
    static public function setTable(int $set)
    {
        switch ($set)
        {
            case 1:
                echo '<table style="width:75%" align="center" border="solid black">';
                break;

            case 2:
                echo '</tbody></table>';
                break;

        }

    }
    static public function readTHeading($tableheading)
    {
        echo '<thead class="thead-dark"><tr>';
        self::generateTHead($tableheading);
        echo '</tr></thead><tbody>';
    }

    static public function generateTHead($tableheading)
    {
        foreach ($tableheading as $heading) {
            echo '<th scope="col">' . $heading . '</th>';
        }
    }

    static public function generateTRows($tableRowData)
    {
        echo '<tr align="center">';
        foreach ($tableRowData as $rowData) {
            echo '<td>' . $rowData . '</td>';
        }
        echo '</tr>';

    }
}








