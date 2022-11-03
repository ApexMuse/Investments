<?php

namespace App\Entity;

class Account
{
    public int $id;
    public string $name;
    public string $account_type;
    public string $institution;
    public string $institution_url;
    public string $owner;
    public string $account_number;
    public float $value;

    public function __construct(array $properties=null)
    {
        if ($properties) {
            foreach ($properties as $property => $value) {
                $this->{$property} = $value;
            }
        }
    }
}