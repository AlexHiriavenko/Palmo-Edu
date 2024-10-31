<?php

namespace Palmo\Model;

class Event
{
  private int $id;
  private string $name;
  private string $category;
  private string $location;
  private \DateTime $dateTime;
  private float $price;

  public function __construct(int $id, string $name, string $category, string $location, \DateTime $dateTime, float $price)
  {
    $this->id = $id;
    $this->name = $name;
    $this->category = $category;
    $this->location = $location;
    $this->dateTime = $dateTime;
    $this->price = $price;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getCategory(): string
  {
    return $this->category;
  }

  public function setCategory(string $category): void
  {
    $this->category = $category;
  }

  public function getLocation(): string
  {
    return $this->location;
  }

  public function setLocation(string $location): void
  {
    $this->location = $location;
  }

  public function getDateTime(): \DateTime
  {
    return $this->dateTime;
  }

  public function setDateTime(\DateTime $dateTime): void
  {
    $this->dateTime = $dateTime;
  }

  public function getPrice(): float
  {
    return $this->price;
  }

  public function setPrice(float $price): void
  {
    $this->price = $price;
  }
}
