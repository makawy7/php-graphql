<?php

namespace App\Controller;

use App\AppContext;
use App\Types;
use App\Types\MutationType;
use App\Types\QueryType;
use GraphQL\GraphQL as GraphQLBase;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use RuntimeException;
use Throwable;

class GraphQL
{
    static public function handle()
    {
        try {
            $schema = new Schema(
                (new SchemaConfig())
                    ->setQuery(new QueryType())
                    ->setMutation(new MutationType())
                    ->setTypeLoader([Types::class, 'load'])
            );

            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new RuntimeException('Failed to get php://input');
            }

            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;

            $rootValue = null;

            $context = new AppContext();
            $result = GraphQLBase::executeQuery($schema, $query, $rootValue, $context, $variableValues);
            $output = $result->toArray();
        } catch (Throwable $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage(),
                ],
            ];
        }

        header('Content-Type: application/json; charset=UTF-8');

        return json_encode($output);
    }
}
