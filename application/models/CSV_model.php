<?php
class csv_model extends CI_Model
{
    /**
	 * Default Constructor
 	*/
    function __construct()
    {

    }

    /**
	 * lees een csv bestand in om een persoon toe te voegen aan de database met personen_model 
     * @param string $soort
	 *  Duid op deelnemer of vrijwilliger
 	*/
    function readpersonen($soort)
    {
        //lees de csv file
        $count=0;
        $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
        $personen = array();
        $datatype = "";

        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            //pak de index van e headers van de csv file op de 1ste lijn
            if($count == 1)
            {
                //lees de 1ste lijn van de file
                $csvheaders = $csv_line[0];
                //slaag de index van de headers op voor later
                if($csvheaders == "naam;nummer;mail;woonplaats;adres"){
                   $datatype = ";";
                } elseif($csv_line[0] == "naam" && $csv_line[1] == "nummer" && $csv_line[2] == "mail" && $csv_line[3] == "woonplaats" && $csv_line[4] == "adres") {
                    $datatype=",";
                } else {
                    return null;
                }
                
                continue;
            }

            //lees lijn per lijn de personen uit 
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $csvdata = $csv_line[0];
            }
            $i++;
            
            if($datatype == ";"){
            $data = explode(";",$csvdata);
            } else {
                $data = $csv_line;
            }

            $persoon = new stdClass();
            
            $persoon->naam = "";
            $persoon->nummer = "";
            $persoon->mail = "";
            $persoon->adres = "";
            $persoon->woonplaats = "";
            
            //kijk of elk element is ingevuld
            //zoniet wordt een null opgelagen in het veld
             if($data[0] != null){
            $persoon->naam = $data[0];
            };

            if($data[1] != null){
            $persoon->nummer = $data[1];
            };

             if($data[2] != null){
            $persoon->mail = $data[2];
            };

             if($data[3] != null){
            $persoon->adres = $data[3];
            };

             if($data[4] != null){
            $persoon->woonplaats = $data[4];
            };

            $persoon->soort = $soort;

            //voeg de gelezen persoon toe
            $this->load->model("Persoon_model");
       		$this->Persoon_model->insert($persoon);

            $personen[] = $persoon;

            
        }
        //einde csv file, stop de functie
        fclose($fp) or die("can't close file");
        return $personen;
    }
}