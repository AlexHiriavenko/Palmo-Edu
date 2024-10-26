<?php

namespace Palmo\Service\Validator;

use Palmo\Interface\ValidatorInterface;

class NameValidator implements ValidatorInterface
{
  private StringValidator $stringValidator;

  public function __construct()
  {
    $this->stringValidator = new StringValidator();
  }

  public function validate($data): bool
  {
    // Сначала проверяем базовую безопасность строки
    if (!$this->stringValidator->validate($data)) {
      return false;
    }

    // Дополнительная проверка специфична для имени: длина > 2
    return strlen(trim($data)) > 2;
  }
}
