<?php declare(strict_types = 1);

namespace App\UI\Presenters;

use App\UI\Components\BasketWidget\BasketWidgetComponent;
use App\UI\Components\BasketWidget\BasketWidgetComponentFactory;
use Nette\Application\UI\Presenter;


abstract class BasePresenter extends Presenter
{

	/** @var BasketWidgetComponentFactory @inject */
	public $basketWidgetComponentFactory;


	protected function createComponentBasketWidget(): BasketWidgetComponent
	{
		return $this->basketWidgetComponentFactory->create();
	}


	protected function beforeRender(): void
	{
		parent::beforeRender();
		$this->redrawControl('title');
		$this->redrawControl('content');
		$this['basketWidget']->redrawControl();
	}

}
