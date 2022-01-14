<?php
class City {
  private $id;
  private $name;

  public function __construct($id, $name) {
    $this->id = $id;
    $this->name = $name;
  }

  // setters
  public function setCityName($name) {
    $this->name = $name;
  }

  // getters
  public function getCityId() {
    return $this->id;
  }

  public function getCityName() {
    return $this->name;
  }

  // functions

  public function deleteCity($id) {

  }
}
