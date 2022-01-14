<?php

class Reservation
{
    private $date;
    private $price;
    private $placeReserved;
    private $tripId;
    private $userId;

    public function __construct(String $date, String $price, String $placeReserved, String $tripId, String $userId)
    {
        $this->date = $date;
        $this->price = $price;
        $this->placeReserved = $placeReserved;
        $this->tripId = $tripId;
        $this->userId = $userId;
    }

    public function getDate(): String
    {
        return $this->date;
    }

    public function setDate(String $date)
    {
        $this->date = $date;
    }

    public function getPrice(): String
    {
        return $this->price;
    }

    public function setPrice(String $price)
    {
        $this->price = $price;
    }

    public function getPlaceReserved(): String
    {
        return $this->placeReserved;
    }

    public function setPlaceReserved(String $placeReserved)
    {
        $this->placeReserved = $placeReserved;
    }

    public function getTripId(): String
    {
        return $this->tripId;
    }

    public function setTripId(String $tripId)
    {
        $this->tripId = $tripId;
    }

    public function getUserId(): String
    {
        return $this->userId;
    }

    public function setUserId(String $userId)
    {
        $this->userId = $userId;
    }
}
