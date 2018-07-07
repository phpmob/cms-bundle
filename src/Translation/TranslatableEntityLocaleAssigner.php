<?php

/*
 * This file is part of the PhpMob package.
 *
 * (c) Ishmael Doss <nukboon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PhpMob\CmsBundle\Translation;

use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Translation\TranslatableEntityLocaleAssignerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TranslatableEntityLocaleAssigner implements TranslatableEntityLocaleAssignerInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function assignLocale(TranslatableInterface $translatableEntity): void
    {
        $context = $this->container->get('sylius.context.locale');
        $provider = $this->container->get('sylius.locale_provider');

        $translatableEntity->setCurrentLocale($context->getLocaleCode());
        $translatableEntity->setFallbackLocale($provider->getDefaultLocaleCode());
    }
}
