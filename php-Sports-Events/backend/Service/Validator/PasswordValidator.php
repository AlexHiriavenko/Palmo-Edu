<?php

namespace Palmo\Service\Validator;

use Palmo\Interface\ValidatorInterface;

class PasswordValidator implements ValidatorInterface
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

    // Дополнительные условия для пароля
    return strpos($data, ' ') === false && strlen($data) > 2;
  }
}
