<?php declare(strict_types = 1);

namespace App\UI\Presenters;

use App\Domain\Catalog\Product;
use App\Domain\Catalog\ProductRepository;
use Nette\Utils\Paginator;


final class ProductListPresenter extends BasePresenter
{

	private const PER_PAGE = 5;


	/** @var ProductRepository */
	private $productRepository;

	/** @var Product[] */
	private $products;

	/** @var Paginator */
	private $paginator;


	public function __construct(ProductRepository $productRepository)
	{
		parent::__construct();
		$this->productRepository = $productRepository;
	}


	public function actionDefault(int $page = 1): void
	{
		$allProducts = $this->productRepository->findAll();

		$this->paginator = new Paginator();
		$this->paginator->setItemCount(\count($allProducts));
		$this->paginator->setPage($page);
		$this->paginator->setItemsPerPage(self::PER_PAGE);

		$offset = $this->paginator->getOffset();
		$this->products = \array_slice($allProducts, $offset, self::PER_PAGE);
	}


	public function renderDefault(): void
	{
		$this->template->products = $this->products;
		$this->template->paginator = $this->paginator;
	}

}
