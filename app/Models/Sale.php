<?php

namespace App\Models;

/**
 *
 */
class Sale
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $totalAmountWithoutTaxes;
    /**
     * @var
     */
    private $totalTaxAmount;
    /**
     * @var
     */
    private $totalAmountWithTaxes;

    /**
     * @param $id
     * @param $date
     * @param $totalAmountWithoutTaxes
     * @param $totalTaxAmount
     * @param $totalAmountWithTaxes
     */
    public function __construct($id, $date, $totalAmountWithoutTaxes, $totalTaxAmount, $totalAmountWithTaxes)
    {
        $this->id = $id;
        $this->date = $date;
        $this->totalAmountWithoutTaxes = $totalAmountWithoutTaxes;
        $this->totalTaxAmount = $totalTaxAmount;
        $this->totalAmountWithTaxes = $totalAmountWithTaxes;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountWithoutTaxes()
    {
        return $this->totalAmountWithoutTaxes;
    }

    /**
     * @param $totalAmountWithoutTaxes
     * @return void
     */
    public function setTotalAmountWithoutTaxes($totalAmountWithoutTaxes)
    {
        $this->totalAmountWithoutTaxes = $totalAmountWithoutTaxes;
    }

    /**
     * @return mixed
     */
    public function getTotalTaxAmount()
    {
        return $this->totalTaxAmount;
    }

    /**
     * @param $totalTaxAmount
     * @return void
     */
    public function setTotalTaxAmount($totalTaxAmount)
    {
        $this->totalTaxAmount = $totalTaxAmount;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountWithTaxes()
    {
        return $this->totalAmountWithTaxes;
    }

    /**
     * @param $totalAmountWithTaxes
     * @return void
     */
    public function setTotalAmountWithTaxes($totalAmountWithTaxes)
    {
        $this->totalAmountWithTaxes = $totalAmountWithTaxes;
    }
}
