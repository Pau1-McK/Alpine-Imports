<?php 

class PurchaseHistory {
  private $id;
  private $product_id;
  private $user_id;
  private $purchase_date;
  private $price;

  public function __construct($product_id, $user_id, $price) {
    $this->product_id = $product_id;
    $this->user_id = $user_id;
    $this->price = $price;
  }

  public function getId() {
    return $this->id;
  }

  public function getProduct_id() {
    return $this->product_id;
  }

  public function setProduct_id($product_id) {
    $this->product_id = $product_id;
  }

  public function getUser_id() {
    return $this->user_id;
  }

  public function setUser_id($user_id) {
    $this->user_id = $user_id;
  }

  public function getPurchase_date() {
    return $this->purchase_date;
  }

  public function setPurchase_date($purchase_date) {
    $this->purchase_date = $purchase_date;
  }

  public function getPrice() {
    return $this->price;
  }

  public function setPrice($price) {
    $this->price = $price;
  }
}