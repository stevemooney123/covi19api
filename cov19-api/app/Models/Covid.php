<?php

namespace App\Models;

class Covid
{
    public $date;
    public $newCases;
    public $dailyDeaths;
    public $cumulativeDeaths;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getnewCases()
    {
        return $this->newCases;
    }

    /**
     * @param mixed $date
     */
    public function setnewCases($newCases): void
    {
        $this->newCases = $newCases;
    }

    /**
     * @return mixed
     */
    public function getdailyDeaths()
    {
        return $this->dailyDeaths;
    }

    /**
     * @param mixed $date
     */
    public function setdailyDeath($dailyDeaths): void
    {
        $this->dailyDeaths = $dailyDeaths;
    }

    /**
     * @return mixed
     */
    public function getcumulativeDeaths()
    {
        return $this->cumulativeDeaths;
    }

    /**
     * @param mixed $date
     */
    public function setcumulativeDeaths($cumulativeDeaths): void
    {
        $this->cumulativeDeaths = $cumulativeDeaths;
    }
}
