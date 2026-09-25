<?php

namespace App\Service;

use App\Entity\Item;

class ItemValidationService {
    public function validate(Item $item): bool {
        return false;
    }
}