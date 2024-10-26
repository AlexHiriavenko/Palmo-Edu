<?php

namespace Palmo\Service\Validator;

use Palmo\Interface\ValidatorInterface;

class EmailValidator implements ValidatorInterface
{
  private StringValidator $stringValidator;

  public function __construct()
  {
    $this->stringValidator = new StringValidator();
  }

  public function validate($data): bool
  {
    // Сначала проверяем безопасность строки
    if (!$this->stringValidator->validate($data)) {
      return false;
    }

    // Затем проверяем формат email
    return filter_var($data, FILTER_VALIDATE_EMAIL) !== false;
  }
}
