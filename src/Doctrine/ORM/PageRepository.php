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

namespace PhpMob\CmsBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use PhpMob\CmsBundle\Repository\SlugableRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Model\SlugAwareInterface;

class PageRepository extends EntityRepository implements SlugableRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findOneBySlug(string $slug): ?SlugAwareInterface
    {
        $qb = $this->createQueryBuilder('o');
        $class = $this->_class->getAssociationMapping('translations')['targetEntity'];

        return $qb
            ->leftJoin('o.translations', 'translation')
            ->leftJoin('o.template', 'tpl')
            ->addSelect('translation')
            ->addSelect('tpl')
            ->where('o.enabled = :enabled')
            ->andWhere($qb->expr()->exists(
                $this->_em->createQueryBuilder()
                    ->select('x')
                    ->from($class, 'x')
                    ->where('x.translatable = o.id')
                    ->andWhere('x.slug = :slug')
            ))
            ->setParameter(':slug', $slug)
            ->setParameter(':enabled', true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $locale
     *
     * @return QueryBuilder
     */
    public function createLocaledQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->join('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->addSelect('translation')
            ->setParameter('locale', $locale);
    }
}
