<?php

namespace Palmo\Database;

class QueryBuilder
{
  protected string $table = '';
  protected array $fields = ['*'];
  protected array $where = [];
  protected array $joins = [];
  protected array $orderBy = [];
  protected ?int $limit = null;
  protected ?int $offset = null;
  protected ?string $countField = '*';  // Поле для подсчёта в COUNT-запросах

  // Установка имени таблицы
  public function table(string $table): self
  {
    $this->table = $table;
    return $this;
  }

  // Установка полей для SELECT-запроса
  public function select(array $fields = ['*']): self
  {
    $this->fields = $fields;
    return $this;
  }

  // Установка поля для COUNT-запроса
  public function count(?string $field = '*'): self
  {
    $this->countField = $field;
    return $this;
  }

  // Условие WHERE
  public function where(string $field, string $operator, $value): self
  {
    $this->where[] = [$field, $operator, $value];
    return $this;
  }

  // Присоединение таблиц (JOIN)
  public function join(string $table, string $field1, string $operator, string $field2, string $type = 'INNER'): self
  {
    $this->joins[] = "$type JOIN $table ON $field1 $operator $field2";
    return $this;
  }

  // Сортировка (ORDER BY)
  public function orderBy(string $field, string $direction = 'ASC'): self
  {
    $this->orderBy[] = "$field $direction";
    return $this;
  }

  // Ограничение (LIMIT)
  public function limit(int $limit): self
  {
    $this->limit = $limit;
    return $this;
  }

  public function offset(int $offset): self
  {
    $this->offset = $offset;
    return $this;
  }

  // Генерация SQL для обычного SELECT-запроса
  public function getSelectSql(): string
  {
    $sql = "SELECT " . implode(', ', $this->fields) . " FROM " . $this->table;

    if (!empty($this->joins)) {
      $sql .= " " . implode(' ', $this->joins);
    }

    if (!empty($this->where)) {
      $conditions = array_map(fn($w) => "$w[0] $w[1] ?", $this->where);
      $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    if (!empty($this->orderBy)) {
      $sql .= " ORDER BY " . implode(', ', $this->orderBy);
    }

    if (!is_null($this->limit)) {
      $sql .= " LIMIT " . $this->limit;
    }

    if (!is_null($this->offset)) {
      $sql .= " OFFSET " . $this->offset;
    }

    return $sql;
  }

  // Генерация SQL для COUNT-запроса
  public function getCountSql(): string
  {
    $sql = "SELECT COUNT(" . $this->countField . ") AS count FROM " . $this->table;

    if (!empty($this->joins)) {
      $sql .= " " . implode(' ', $this->joins);
    }

    if (!empty($this->where)) {
      $conditions = array_map(fn($w) => "$w[0] $w[1] ?", $this->where);
      $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    return $sql;
  }

  // Получение привязок параметров для запросов
  public function getBindings(): array
  {
    return array_map(fn($w) => $w[2], $this->where);
  }
}
