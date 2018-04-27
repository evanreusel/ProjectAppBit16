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
                $csvheaders = "ring\t";
                $csvheaders .= $csv_line[0];
                //klaarmaken om de headers te splitsen
                $csvheaders = str_replace(";","\t",$csvheaders);
                $csvheaders = str_replace(" ","",$csvheaders);
                //splits de headers
                $headers = explode("\t",$csvheaders);
                //slaag de index van de headers op voor later
                $naamindex = array_search("naam",$headers);
                $nummerindex = array_search("nummer",$headers);
                $mailindex = array_search("mail",$headers);
                $adresindex = array_search("adres",$headers);
                $woonplaatsindex = array_search("woonplaats",$headers);
                continue;

            }

            //lees lijn per lijn de personen uit 
            $csvdata = "dummy\t";
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $csvdata .= $csv_line[0];
            }
            $i++;
            $csvdata = str_replace(";","\t",$csvdata);
            $data = explode("\t",$csvdata);
            $persoon = new stdClass();
            
             if($naamindex != null){
            $persoon->naam = $data[$naamindex];
            };

            if($nummerindex != null){
            $persoon->nummer = $data[$nummerindex];
            };

             if($mailindex != null){
            $persoon->mail = $data[$mailindex];
            };

             if($adresindex != null){
            $persoon->adres = $data[$adresindex];
            };

             if($woonplaatsindex != null){
            $persoon->woonplaats = $data[$woonplaatsindex];
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