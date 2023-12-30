<?php
namespace App\Services;
interface Newsletter{

    public function subscribe(String $email, string $List =null);
}