<?php
class csv_model extends CI_Model
{
    function __construct()
    {
    }

    //lees een csv bestand in om een persoon toe te voegen aan de database met personen_model
    function readpersonen($soort)
    {
        //lees de csv file
        $count=0;
        $fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
        $personen = array();

        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            //pak de index van e headers van de csv file op de 1ste lijn
            if($count == 1)
            {
                //lees de 1ste lijn van de file
                $csvheaders = $csv_line[0];
                //slaag de index van de headers op voor later
                if($csvheaders != "naam\tnummer\tmail\twoonplaats\tadres"){
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
            $data = explode("\t",$csvdata);
            $persoon = new stdClass();
            
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