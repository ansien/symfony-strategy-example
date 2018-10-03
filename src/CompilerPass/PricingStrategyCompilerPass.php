<?php

namespace App\CompilerPass;

use App\PricingStrategy\PricingStrategyContext;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PricingStrategyCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        // Find the definition of our context service
        $contextDefinition = $container->findDefinition(PricingStrategyContext::class);

        // Find the definitions of all the strategy services
        $strategyServiceIds = array_keys(
            $container->findTaggedServiceIds('pricing_strategy')
        );

        // Call the addStrategy method on the context for each strategy
        foreach ($strategyServiceIds as $strategyServiceId) {
            $contextDefinition->addMethodCall(
                'addStrategy',
                [ $strategyServiceId, new Reference($strategyServiceId) ]
            );
        }
    }
}
