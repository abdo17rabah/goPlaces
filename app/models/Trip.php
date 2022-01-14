<?php
class Trip {
  private $id;
  private $name;
  private $date;
  private $price;
  private $availablePlaces;

  public function __construct($id, $name, $date, $price, $availablePlaces) {
    $this->id = $id;
    $this->name = $name;
    $this->date = $date;
    $this->price = $price;
    $this->availablePlaces = $availablePlaces;
  }

  // setters
  public function setTripName($name) {
    $this->name = $name;
  }

  public function setTripDate($date) {
    $this->date = $date;
  }

  public function setTripAvailablePlaces($availablePlaces) {
    $this->availablePlaces = $availablePlaces;
  }

  public function setTripPrice($price) {
    $this->price = $price;
  }

  // getters
  public function getTripId() {
    return $this->id;
  }

  public function getTripName() {
    return $this->name;
  }

  public function getTripDate() {
    return $this->date;
  }

  public function getTripPrice() {
    return $this->price;
  }

  public function getTripAvailablePlaces() {
    return $this->availablePlaces;
  }

  // functions

}
