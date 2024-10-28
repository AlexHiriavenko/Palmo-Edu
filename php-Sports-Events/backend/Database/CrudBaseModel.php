<?php

namespace Palmo\Database;

use PDO;
use PDOException;

class CrudBaseModel
{
  protected PDO $db;

  public function __construct(Db $db)
  {
    $this->db = $db->getPdoInstance();
  }

  // Обработка ошибок
  protected function handleError(PDOException $e): void
  {
    throw new \Exception("Database error: " . $e->getMessage());
  }

  // Create (вставка данных)
  public function create(string $table, array $data): bool
  {
    try {
      $fieldNames = implode('`, `', array_keys($data));
      $placeholders = ':' . implode(', :', array_keys($data));
      $sql = "INSERT INTO `$table` (`$fieldNames`) VALUES ($placeholders)";

      $stmt = $this->db->prepare($sql);

      foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
      }

      return $stmt->execute();
    } catch (PDOException $e) {
      $this->handleError($e);
      return false;
    }
  }

  // Update (обновление записи)
  public function update(string $table, int $id, array $data): bool
  {
    try {
      $fieldDetails = implode(', ', array_map(fn($key) => "`$key` = :$key", array_keys($data)));
      $sql = "UPDATE `$table` SET $fieldDetails WHERE id = :id";

      $stmt = $this->db->prepare($sql);
      foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
      }
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      $this->handleError($e);
      return false;
    }
  }

  // Delete (удаление записи)
  public function delete(string $table, int $id): bool
  {
    try {
      $sql = "DELETE FROM `$table` WHERE id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (PDOException $e) {
      $this->handleError($e);
      return false;
    }
  }

  // Использование QueryBuilder для чтения записи по ID
  public function readById(string $table, int $id, $fetchMode = PDO::FETCH_ASSOC): array|null
  {
    try {
      $queryBuilder = new QueryBuilder();
      $sql = $queryBuilder
        ->table($table)
        ->where('id', '=', $id)
        ->limit(1)
        ->getSelectSql();

      $stmt = $this->db->prepare($sql);
      $stmt->execute([$id]);

      $result = $stmt->fetch($fetchMode);

      if (is_array($result)) return $result;
      return null;
    } catch (PDOException $e) {
      $this->handleError($e);
      return [];
    }
  }

  // Получение событий с фильтрацией и пагинацией
  public function readFiltered(string $table, array $filters = [], ?int $limit = null, ?int $offset = 0, $fetchMode = PDO::FETCH_ASSOC): array
  {
    try {
      $queryBuilder = new QueryBuilder();
      $queryBuilder->table($table);

      foreach ($filters as $field => $value) {
        $queryBuilder->where($field, '=', $value);
      }

      if ($limit !== null) {
        $queryBuilder->limit($limit)->offset($offset);
      }

      $sql = $queryBuilder->getSelectSql();
      $bindings = $queryBuilder->getBindings();

      $stmt = $this->db->prepare($sql);
      $stmt->execute($bindings);

      return $stmt->fetchAll($fetchMode);
    } catch (PDOException $e) {
      $this->handleError($e);
      return [];
    }
  }

  // Подсчёт записей с фильтрацией
  public function countFiltered(string $table, array $filters = []): int
  {
    try {
      $queryBuilder = new QueryBuilder();
      $queryBuilder->table($table)->count();

      foreach ($filters as $field => $value) {
        $queryBuilder->where($field, '=', $value);
      }

      $sql = $queryBuilder->getCountSql();
      $bindings = $queryBuilder->getBindings();

      $stmt = $this->db->prepare($sql);
      $stmt->execute($bindings);

      return (int)$stmt->fetchColumn();
    } catch (PDOException $e) {
      $this->handleError($e);
      return 0;
    }
  }

  // Count rows (подсчёт строк в таблице)
  public function rowsCount(string $table, array $conditions = []): int
  {
    try {
      $queryBuilder = new QueryBuilder();
      $queryBuilder->table($table)->count();  // Настраиваем COUNT-запрос

      foreach ($conditions as $field => $value) {
        $queryBuilder->where(
          $field,
          '=',
          $value
        );
      }

      $sql = $queryBuilder->getCountSql();  // Получаем SQL для COUNT-запроса
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array_values($conditions));

      return (int) $stmt->fetchColumn();  // Получаем количество строк
    } catch (PDOException $e) {
      $this->handleError($e);
      return 0;
    }
  }
}
