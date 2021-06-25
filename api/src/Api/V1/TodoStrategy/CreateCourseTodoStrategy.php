<?php

namespace App\Api\V1\TodoStrategy;

use App\Todo\Application\Course\Command\CreateCourseCommand;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\DataType;
use AutoMapperPlus\MappingOperation\Operation;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;
use Symfony\Component\HttpFoundation\Request;

class CreateCourseTodoStrategy implements CreateTodoStrategyInterface
{
    public function check(string $type): bool
    {
        return $type === 'course';
    }

    public function handle(Request $request): object
    {
        $config = new AutoMapperConfig();

        $config->registerMapping(DataType::ARRAY, CreateCourseCommand::class)
            ->forMember('id', Operation::ignore())
            ->withNamingConventions(
                new CamelCaseNamingConvention(),
                new SnakeCaseNamingConvention()
            );

        $mapper = new AutoMapper($config);

        return $mapper->map($request->request->all(), CreateCourseCommand::class);
    }
}
