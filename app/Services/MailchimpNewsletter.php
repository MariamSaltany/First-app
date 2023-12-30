<?php
 namespace App\Services;
use MailchimpMarketing\ApiClient;
use Illuminate\Validation\ValidationException;
 class MailchimpNewsletter implements Newsletter{

  public function __construct(protected ApiClient $client){
    
  }
    public function subscribe(String $email, string $List =null){
      $List ??= config('services.mailchimp.lists.subscribers');
      $mailchimp = new ApiClient();

          
       return  $this->client->lists->addListMember($List,[
        'email_address'=>$email,
        'status'=> 'subscribed'
      ]);
    }
 }