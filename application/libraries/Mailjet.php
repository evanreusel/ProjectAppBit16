<?php

/**
 * Created by PhpStorm.
 * User: erik
 * Date: 19/04/18
 * Time: 23:11
 */
class Mailjet
{

    //private $key = "953f6f7ade8e9dde2005d811eee8752b";
    //private $secret = "cecefe743a41d7f6ba62444b39127d30";
    private $key = "b11e7e781e0b494ec7737d0d39c6b285";
    private $secret = " 731356aa3c11146d8d01ec92a7add6d6";


    private $afzenderEmail = "r0581776@student.thomasmore.be";
    private $afzenderNaam = "Thomas More Events";

    private $Messages = array();
    /**
     * Voegt een berichtobject toe aan de array Messages
     * @param mail $id
     *  Id van gebruiker
     */
    public function voegBerichtObjectToe($berichtObject)
    {
        array_push($this->Messages, $berichtObject);
        return count($this->Messages);
    }
    /**
     * Toont de array Messages

     */
    public function toonBerichtObject()
    {
        return $this->Messages;
    }
    /**
     * Maakt het bericht object leeg
     */
    public function leegBerichtObject()
    {
        unset($this->Messages);
        $this->Messages = array();

    }
    /**
     * Maakt een berichtobject op basis van de syntax van Mailjet
     * @param string $ontvangerEmail
     *  Email van de ontvanger
     * @param string $ontvangerNaam
     *  Naam van de ontvanger
     * @param string $onderwerp
     *  Onderwerp van de mail
     * @param string $inhoud
     *  Onderwerp van de inhoud
     */
    public function maakBerichtObject($ontvangerEmail, $ontvangerNaam, $onderwerp, $inhoud, $inhoudHtml)
    {
        $mail = new stdClass();
        //
        $afzender = new stdClass();
        $afzender->Email = $this->afzenderEmail;
        $afzender->Name = $this->afzenderNaam;
        $mail->From = $afzender;
        //
        $ontvanger = new stdClass();
        $ontvanger->Email = $ontvangerEmail;
        $ontvanger->Name = $ontvangerNaam;
        $mail->To = array($ontvanger);
        $mail->Subject = $onderwerp;
        $mail->TextPart = $inhoud;
        $mail->HtmlPart = $inhoudHtml;
        return $mail;
    }
    /**
     * Vult een sjabloon door gekende variabelen te vervangen met gegevens uit de database
     * @param sjabloon $sjabloon
     *  Sjabloon voor de email
     * @param persoon $persoon
     *  Persoonsgegevens voor de email
     */
    public function vulSjabloon($sjabloon, $persoon)
    {
        $variabelen = array();
        return strtr($sjabloon, $variabelen);
    }
    /**
     * Verstuurt het mailobject met curl request
     */
    public function verstuur()
    {
        $mailjetData = new stdClass();
        $mailjetData->Messages = $this->Messages;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mailjetData));

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->key . ":" . $this->secret);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;
    }

}