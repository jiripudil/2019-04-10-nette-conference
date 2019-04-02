<?php declare(strict_types = 1);

namespace App\Domain\Catalog;


final class Product
{

	/** @var int */
	private $id;

	/** @var string */
	private $name;

	/** @var string */
	private $description;

	/** @var string */
	private $imageUrl;

	/** @var float */
	private $price;


	public function __construct(
		int $id,
		string $name,
		string $description,
		string $imageUrl,
		float $price
	)
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->imageUrl = $imageUrl;
		$this->price = $price;
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getDescription(): string
	{
		return $this->description;
	}


	public function getImageUrl(): string
	{
		return $this->imageUrl;
	}


	public function getPrice(): float
	{
		return $this->price;
	}

}
