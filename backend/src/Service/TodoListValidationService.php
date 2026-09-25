<?php

namespace App\Service;

use App\Entity\TodoList;

class TodoListValidationService {
    public function validate(TodoList $todoList): bool {
        return false;
    }
}