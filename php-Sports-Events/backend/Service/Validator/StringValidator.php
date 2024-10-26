<?php

namespace Palmo\Service\Validator;

use Palmo\Interface\ValidatorInterface;

class StringValidator implements ValidatorInterface
{
  public function validate($data): bool
  {
    return is_string($data)
      && strlen(trim($data)) > 0
      && $data === htmlspecialchars(strip_tags($data), ENT_COMPAT);
  }
}
