<?php

namespace Palmo\Interface;

interface ValidatorInterface
{
  public function validate($data): bool;
}
