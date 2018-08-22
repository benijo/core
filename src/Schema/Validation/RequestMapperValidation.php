<?php declare(strict_types = 1);

namespace Apitte\Core\Schema\Validation;

use Apitte\Core\Exception\Logical\InvalidSchemaException;
use Apitte\Core\Mapping\Request\IRequestEntity;
use Apitte\Core\Schema\Builder\SchemaBuilder;

class RequestMapperValidation implements IValidation
{

	public function validate(SchemaBuilder $builder): void
	{
		$this->validateEntityClassname($builder);
	}

	protected function validateEntityClassname(SchemaBuilder $builder): void
	{
		$controllers = $builder->getControllers();

		foreach ($controllers as $controller) {
			foreach ($controller->getMethods() as $method) {

				$mapper = $method->getRequestMapper();

				// Skip if @RequestMapper is not set
				if ($mapper === null) continue;

				if (!class_exists($mapper->getEntity(), true)) {
					throw new InvalidSchemaException(
						sprintf(
							'Request mapping entity "%s" in "%s::%s()" does not exist"',
							$mapper->getEntity(),
							$controller->getClass(),
							$method->getName()
						)
					);
				}

				if (!isset(class_implements($mapper->getEntity())[IRequestEntity::class])) {
					throw new InvalidSchemaException(sprintf(
						'Request mapping entity "%s" in "%s::%s()" does not implement "%s"',
						$mapper->getEntity(),
						$controller->getClass(),
						$method->getName(),
						IRequestEntity::class
					));
				}
			}
		}
	}

}
