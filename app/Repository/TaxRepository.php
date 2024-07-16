<?php

namespace App\Repository;

class TaxRepository
{
    public function getAllTaxes()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM taxes");
        $taxes = [];
        while ($row = $stmt->fetch()) {
            $taxes[] = new Tax($row['id'], $row['name'], $row['rate']);
        }
        return $taxes;
    }

    public function getTaxById($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM taxes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return new Tax($row['id'], $row['name'], $row['rate']);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM taxes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM taxes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(Tax $tax)
    {
        $sql = "INSERT INTO taxes (name, percentage) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tax->getName(), $tax->getPercentage()]);
        $tax->setId($this->pdo->lastInsertId());
        return $tax;
    }

    public function update(Tax $tax)
    {
        $sql = "UPDATE taxes SET name = ?, percentage = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$tax->getName(), $tax->getPercentage(), $tax->getId()]);
        return $stmt->rowCount() > 0;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM taxes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}
