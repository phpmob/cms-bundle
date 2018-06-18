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

namespace PhpMob\CmsBundle\Repository;

use Sylius\Component\Resource\Model\SlugAwareInterface;

interface SlugableRepositoryInterface
{
    /**
     * @param string $slug
     * @param null|string $locale
     *
     * @return null|object|SlugAwareInterface
     */
    public function findBySlug(string $slug, ?string $locale): ?SlugAwareInterface;
}
