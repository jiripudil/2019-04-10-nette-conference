<?php declare(strict_types = 1);

namespace App\UI\Presenters;

use App\Domain\Basket\Basket;


final class BasketPresenter extends BasePresenter
{

	/** @var Basket */
	private $basket;


	public function __construct(Basket $basket)
	{
		parent::__construct();
		$this->basket = $basket;
	}


	public function renderDefault(): void
	{
		$this->template->totalPrice = $this->basket->getTotalPrice();
		$this->template->items = $this->basket->getItems();
	}

}
