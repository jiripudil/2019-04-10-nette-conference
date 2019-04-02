<?php declare(strict_types = 1);

namespace App\UI\Components\AddToBasketButton;

use App\Domain\Basket\Basket;
use App\Domain\Catalog\Product;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;


/**
 * @method void onChange()
 */
final class AddToBasketButtonComponent extends Control
{

	/** @var callable[] */
	public $onChange = [];

	/** @var Product */
	private $product;

	/** @var Basket */
	private $basket;


	public function __construct(
		Product $product,
		Basket $basket
	)
	{
		$this->product = $product;
		$this->basket = $basket;
	}


	public function render(): void
	{
		$basketItem = $this->basket->getItem($this->product);
		$this->template->render(__DIR__ . '/AddToBasketButtonComponent.latte', [
			'item' => $basketItem,
		]);
	}


	public function handleAdd(): void
	{
		$this->basket->add($this->product);
		$this->onChange();
	}


	protected function createComponentForm(): Form
	{
		$form = new Form();

		$subtract = $form->addSubmit('subtract', '–');
		$subtract->onClick[] = function (): void {
			$this->basket->subtract($this->product);
			$this->onChange();
		};

		$add = $form->addSubmit('add', '+');
		$add->onClick[] = function (): void {
			$this->basket->add($this->product);
			$this->onChange();
		};

		return $form;
	}

}
