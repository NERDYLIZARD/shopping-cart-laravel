<?php

namespace App;


class Cart
{
  // associative array $items
  public $items = null;
  public $totalQty = 0;
  public $totalPrice = 0;

  public function __construct($existingCart)
  {
    if ($existingCart) {
      $this->items = $existingCart->items;
      $this->totalQty = $existingCart->totalQty;
      $this->totalPrice = $existingCart->totalPrice;
    }
  }

  public function add($product)
  {
    $itemInCart = $this->items && array_key_exists($product->id, $this->items);
    $processingItem = $itemInCart ?
      $this->items[$product->id] : [
        'product' => $product,
        'price' => 0,
        'qty' => 0
      ];

    $processingItem['qty']++;
    $processingItem['price'] = $product->price * $processingItem['qty'];

    $this->items[$product->id] = $processingItem;
    $this->totalQty++;
    $this->totalPrice += $product->price;
  }

}
