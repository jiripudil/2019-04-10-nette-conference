<?php declare(strict_types = 1);

namespace App\UI\Presenters;

use App\Domain\Catalog\Product;
use App\Domain\Catalog\ProductRepository;
use App\UI\Components\AddToBasketButton\AddToBasketButtonComponent;
use App\UI\Components\AddToBasketButton\AddToBasketButtonComponentFactory;


final class ProductDetailPresenter extends BasePresenter
{

	/** @var ProductRepository */
	private $productRepository;

	/** @var AddToBasketButtonComponentFactory */
	private $addToBasketButtonComponentFactory;

	/** @var Product */
	private $product;


	public function __construct(
		ProductRepository $productRepository,
		AddToBasketButtonComponentFactory $addToBasketButtonComponentFactory
	)
	{
		parent::__construct();
		$this->productRepository = $productRepository;
		$this->addToBasketButtonComponentFactory = $addToBasketButtonComponentFactory;
	}


	public function actionDefault(int $id): void
	{
		$this->product = $this->productRepository->getById($id);
		if ($this->product === null) {
			$this->error();
		}
	}


	public function renderDefault(): void
	{
		$this->template->product = $this->product;
	}


	protected function createComponentAddToBasket(): AddToBasketButtonComponent
	{
		$control = $this->addToBasketButtonComponentFactory->create($this->product);
		$control->onChange[] = function (): void {
			$this->redrawControl('content');
			$this['basketWidget']->redrawControl();
		};

		return $control;
	}

}
