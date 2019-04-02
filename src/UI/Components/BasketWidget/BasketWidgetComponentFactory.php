<?php declare(strict_types = 1);

namespace App\UI\Components\BasketWidget;


interface BasketWidgetComponentFactory
{

	public function create(): BasketWidgetComponent;

}
