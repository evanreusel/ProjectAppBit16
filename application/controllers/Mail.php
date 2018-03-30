<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function generateData()
    {
        $sendgridData = new stdClass();

        //Generate personalizations
        $personalizations = new stdClass();
        $to = array();

        $firstReceiver = new stdClass();
        $firstReceiver->email = "evanreusel@gmail.com";
        $firstReceiver->name = "Erik";
        array_push($to, $firstReceiver);
        $bcc = array();
        //TODO: Add foreach for every single email address
        $secondEmail = new stdClass();
        $secondEmail->email = "r0581776@student.thomasmore.be";
        $secondEmail->name = "Erik";
        array_push($bcc, $secondEmail);
        $personalizations->to = $to;
        $sendgridData->personalizations = $personalizations;

        //generate Content mail
        $content = array();
        $contentItem = new stdClass();
        $contentItem->type = "text/html";
        $contentItem->value = "SENDGRID MAIL TEST";
        array_push($content, $contentItem);
        $sendgridData->content = $content;

        echo json_encode($sendgridData);
    }
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function send()
    {
        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"personalizations\": [{\"to\": [{\"email\": \"evanreusel@gmail.com\"}]}],\"from\": {\"email\": \"dirkdepeuter@outlookforandroid.be\"},\"subject\": \"Sending with SendGrid is Fun\",\"content\": [{\"type\": \"text/plain\", \"value\": \"and easy to do anywhere, even with cURL\"}]}");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Authorization: Bearer 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";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

    }
}
