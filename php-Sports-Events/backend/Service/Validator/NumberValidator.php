<?php

namespace Palmo\Service\Validator;

use Palmo\Interface\ValidatorInterface;

class NumberValidator implements ValidatorInterface
{
  public function validate($data): bool
  {
    return is_numeric($data);
  }
}
