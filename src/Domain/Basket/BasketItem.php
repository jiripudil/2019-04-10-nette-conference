<?php declare(strict_types = 1);

namespace App\Domain\Basket;

use App\Domain\Catalog\Product;


final class BasketItem
{

	/** @var Product */
	public $product;

	/** @var int */
	public $amount;


	public function __construct(Product $product, int $amount)
	{
		$this->product = $product;
		$this->amount = $amount;
	}

}
