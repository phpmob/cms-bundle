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

interface TemplateAwareInterface
{
    /**
     * @return TemplateInterface|null
     */
    public function getTemplate(): ?TemplateInterface;

    /**
     * @param TemplateInterface|null $template
     */
    public function setTemplate(?TemplateInterface $template): void;

    /**
     * @return string
     */
    public function getTemplateName(): ?string;
}
