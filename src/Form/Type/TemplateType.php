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

namespace PhpMob\CmsBundle\Form\Type;

use PhpMob\AceBundle\Form\Type\AceType;
use PhpMob\CmsBundle\Model\TemplateInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TemplateType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'phpmob.form.template.type',
                'required' => true,
                'choices' => array_flip([
                    TemplateInterface::TYPE_NORMAL => 'phpmob.form.template.type_normal',
                    TemplateInterface::TYPE_ABSTRACT => 'phpmob.form.template.type_abstract',
                ]),
            ])
            ->add('name', TextType::class, [
                'label' => 'phpmob.form.template.name',
                'required' => true,
            ])
            ->add('content', AceType::class, [
                'label' => 'phpmob.form.template.content',
                'mode' => 'twig',
                'required' => true,
            ])
            ->add('options', YamlType::class, [
                'label' => 'phpmob.form.template.options',
                'required' => false,
            ])
            ->add('definedTranslations', YamlType::class, [
                'label' => 'phpmob.form.template.defined_translations',
                'required' => false,
            ])
        ;
    }
}
