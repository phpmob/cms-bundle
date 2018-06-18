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

namespace PhpMob\CmsBundle\Controller;

use FOS\RestBundle\View\View;
use PhpMob\CmsBundle\Model\DefinedTranslationInterface;
use PhpMob\CmsBundle\Model\TemplateAwareInterface;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends ResourceController
{
    /**
     * @param DefinedTranslationInterface $resource
     */
    private function addTranslations(DefinedTranslationInterface $resource)
    {
        $this->get('phpmob.locale.add_defined_translation')->addTranslations($resource);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function viewAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::SHOW);

        /** @var DefinedTranslationInterface|TemplateAwareInterface|ResourceInterface $resource */
        $resource = $this->findOr404($configuration);

        $this->eventDispatcher->dispatch(ResourceActions::SHOW, $configuration, $resource);

        $view = View::create($resource);

        if ($configuration->isHtmlRequest()) {
            $template = $resource->getTemplate();

            if ($template) {
                $tpl = $resource->getTemplateName();
                $options = $template->getOptions();
            } else {
                $tpl = $configuration->getTemplate(ResourceActions::SHOW.'.html');
                $options = [];
            }

            $this->addTranslations($resource);

            $view
                ->setTemplate($tpl)
                ->setTemplateVar($this->metadata->getName())
                ->setData(
                    [
                        'configuration' => $configuration,
                        'metadata' => $this->metadata,
                        'resource' => $resource,
                        'tpl' => ['options' => $options],
                        $this->metadata->getName() => $resource,
                    ]
                );
        }

        return $this->viewHandler->handle($configuration, $view);
    }
}
