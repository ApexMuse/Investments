<?php

namespace App\Entity;

use DateTime;
use Knp\Bundle\TimeBundle\DateTimeFormatter;
use Symfony\Component\PropertyAccess\PropertyAccess;

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
    public DateTime $created_at;
    public DateTime $updated_at;
    public ?DateTime $deleted_at;

    public function __construct(array $properties=null)
    {
        if ($properties) {
            foreach ($properties as $property => $value) {
                $this->{$property} = $value;
            }
        }
    }

    public function getCreatedAt(DateTimeFormatter $dateTimeFormatter): string
    {
        return $dateTimeFormatter->formatDiff($this->created_at);
    }
}