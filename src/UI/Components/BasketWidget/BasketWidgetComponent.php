<?php declare(strict_types = 1);

namespace App\UI\Components\BasketWidget;

use App\Domain\Basket\Basket;
use Nette\Application\UI\Control;


final class BasketWidgetComponent extends Control
{

	/** @var Basket */
	private $basket;


	public function __construct(Basket $basket)
	{
		$this->basket = $basket;
	}


	public function render(): void
	{
		$this->template->render(__DIR__ . '/BasketWidgetComponent.latte', [
			'itemsCount' => $this->basket->getItemsCount(),
			'totalPrice' => $this->basket->getTotalPrice(),
		]);
	}

}
