<?php

namespace Geekbrains\Application1\Models;

class Phone
{
    private string $phone;
    public function __construct()
    {
        $this->phone = '+79942341323';
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

}