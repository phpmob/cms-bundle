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

namespace PhpMob\CmsBundle\Model;

interface DefinedTranslationInterface
{
    /**
     * @return array
     */
    public function getDefinedTranslations(): array;

    /**
     * @param array $trans
     */
    public function setDefinedTranslations(array $trans);
}
