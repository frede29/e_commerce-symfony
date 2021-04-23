<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail{

    private $api_key = '6a6c97eee075a579e1ecf51503a4ee0e';
    private $api_key_secret =  '2cebf0e6d7221eccaacc121b2ff90f69';

    public function send($to_email, $to_name, $subject, $content)
    {


    $mj = new Client($this->api_key, $this->api_key_secret,true,['version'=>'v3.1']);

         $body = [
             'Messages' => [
              [
                 'From' => [
                  'Email' => "angela.asere29@gmail.com",
                   'Name' => "E_commerce"
                ],
                 'To' => [
                   [
                     'Email' => $to_email,
                     'Name' => $to_name,
                   ]
                 ],
                 'TemplateID' => 2672619,
                'TemplateLanguage' => true,
                 'Subject' => $subject,
                'Variables' => [
                   'content' => $content,
                ]
               ]
            ]
           ];





          $response = $mj->post(Resources::$Email, ['body' => $body]);
          $response->success();

    }
}




?>
