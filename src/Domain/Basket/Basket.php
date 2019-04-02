<?php declare(strict_types = 1);

namespace App\Domain\Basket;

use App\Domain\Catalog\Product;
use App\Domain\Catalog\ProductRepository;
use Nette\Http\Session;
use Nette\Http\SessionSection;


final class Basket
{

	/** @var SessionSection */
	private $session;

	/** @var ProductRepository */
	private $productRepository;


	public function __construct(
		Session $session,
		ProductRepository $productRepository
	)
	{
		$this->session = $session->getSection(__CLASS__);
		$this->session['items'] = $this->session['items'] ?? [];
		$this->productRepository = $productRepository;
	}


	/**
	 * @return BasketItem[]
	 */
	public function getItems(): array
	{
		return $this->session['items'] ?? [];
	}


	public function getItem(Product $product): ?BasketItem
	{
		foreach ($this->getItems() as $item) {
			if ($item->product->getId() === $product->getId()) {
				return $item;
			}
		}

		return null;
	}


	public function add(Product $product): void
	{
		$amount = 1;

		foreach ($this->getItems() as $item) {
			if ($item->product->getId() === $product->getId()) {
				$item->amount += $amount;
				return;
			}
		}

		$this->session->items[] = new BasketItem($product, $amount);
	}


	public function subtract(Product $product): void
	{
		$amount = 1;

		foreach ($this->getItems() as $item) {
			if ($item->product->getId() === $product->getId()) {
				$item->amount -= $amount;
				if ($item->amount <= 0) {
					$this->remove($product);
				}

				return;
			}
		}
	}


	public function remove(Product $product): void
	{
		$newItems = [];
		foreach ($this->getItems() as $item) {
			if ($item->product->getId() !== $product->getId()) {
				$newItems[] = $item;
			}
		}

		$this->session->items = $newItems;
	}


	public function getItemsCount(): int
	{
		$itemsCount = 0;
		foreach ($this->getItems() as $item) {
			$itemsCount += $item->amount;
		}

		return $itemsCount;
	}


	public function getTotalPrice(): float
	{
		$totalPrice = 0.0;
		foreach ($this->getItems() as $item) {
			$totalPrice += $item->product->getPrice() * $item->amount;
		}

		return $totalPrice;
	}

}
