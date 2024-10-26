<?php

namespace Palmo\Service\Validator;

use Exception;

class Validator
{
  protected $type;
  protected $data;
  protected $validator;

  public function __construct($type, $data)
  {
    $this->type = $type;
    $this->data = $data;
    $this->setValidator();
  }

  protected function setValidator()
  {
    switch ($this->type) {
      case 'string':
        $this->validator = new StringValidator();
        break;
      case 'number':
        $this->validator = new NumberValidator();
        break;
      case 'email':
        $this->validator = new EmailValidator();
        break;
      case 'password':
        $this->validator = new PasswordValidator();
        break;
      case 'name':
        $this->validator = new NameValidator();
        break;
      default:
        throw new Exception("validate error.");
    }
  }

  public function validate(): bool
  {
    return $this->validator->validate($this->data);
  }
}
