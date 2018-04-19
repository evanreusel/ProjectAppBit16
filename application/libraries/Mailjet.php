<?php

/**
 * Created by PhpStorm.
 * User: erik
 * Date: 19/04/18
 * Time: 23:11
 */
class Mailjet
{
    private $key = "953f6f7ade8e9dde2005d811eee8752b";
    private $secret = "cecefe743a41d7f6ba62444b39127d30";


    private $afzenderEmail = "r0581776@student.thomasmore.be";
    private $afzenderNaam = "Thomas More Events";

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
}