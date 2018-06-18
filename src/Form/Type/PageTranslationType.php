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

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PageTranslationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'phpmob.form.page.title',
                'required' => true,
            ])
            ->add('slug', TextType::class, [
                'label' => 'phpmob.form.page.slug',
                'required' => true,
            ])
            ->add('body', CKEditorType::class, [
                'label' => 'phpmob.form.page.body',
                'required' => true,
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'phpmob.form.page.meta_description',
                'required' => false,
            ])
            ->add('metaKeywords', TextType::class, [
                'label' => 'phpmob.form.page.meta_keywords',
                'required' => false,
            ])
        ;
    }
}
