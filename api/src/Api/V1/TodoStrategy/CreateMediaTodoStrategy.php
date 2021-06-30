<?php

namespace App\Api\V1\TodoStrategy;

use App\Todo\Application\Command\CreateMediaCommand;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\DataType;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Symfony\Component\HttpFoundation\Request;

class CreateMediaTodoStrategy implements CreateTodoStrategyInterface
{
    public function check(string $type): bool
    {
        return $type === 'media';
    }

    public function handle(Request $request): object
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(DataType::ARRAY, CreateMediaCommand::class)
            ->forMember('id', Operation::ignore())
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $mapper = new AutoMapper($config);

        return $mapper->map($request->request->all(), CreateMediaCommand::class);
    }
}
