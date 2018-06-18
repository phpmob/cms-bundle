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

use Sylius\Component\Resource\Model\TimestampableTrait;

class Template implements TemplateInterface
{
    use TimestampableTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $type = self::TYPE_NORMAL;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $definedTranslations = [];

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): string
    {
        return (string)$this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return (string)$this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function isAbstractType()
    {
        return $this->type === self::TYPE_ABSTRACT;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions(): array
    {
        return (array)$this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinedTranslations(): array
    {
        return $this->definedTranslations;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefinedTranslations(array $definedTranslations)
    {
        $this->definedTranslations = $definedTranslations;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getContent();
    }
}
