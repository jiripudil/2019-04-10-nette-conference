<?php declare(strict_types = 1);

namespace App\UI\Components\AddToBasketButton;

use App\Domain\Catalog\Product;


interface AddToBasketButtonComponentFactory
{

	public function create(Product $product): AddToBasketButtonComponent;

}
