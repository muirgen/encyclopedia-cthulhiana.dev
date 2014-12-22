<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesArticles
 *
 * @ORM\Table(name="catalogues_articles")
 * @ORM\Entity
 */
class CataloguesArticles {

    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Catalogues", inversedBy="articles")
     * @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     */
    protected $catalogues;
    
    /**
     * @var text
     * 
     * @ORM\Column(name="article_content", type="text")
     */
    protected $articleContent;
    
    /**
     * @var String
     * Iso code, take value from iso_code in table Lang. No FK, let the possibility 
     * to keep the code without the language reference and show the origin of the translation
     * 
     * @ORM\Column(name="iso_code", type="string", length=2, nullable=false)
     */
    protected $isocode;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set articleContent
     *
     * @param string $articleContent
     * @return CataloguesArticles
     */
    public function setArticleContent($articleContent)
    {
        $this->articleContent = $articleContent;

        return $this;
    }

    /**
     * Get articleContent
     *
     * @return string 
     */
    public function getArticleContent()
    {
        return $this->articleContent;
    }

    /**
     * Set isocode
     *
     * @param string $isocode
     * @return CataloguesArticles
     */
    public function setIsocode($isocode)
    {
        $this->isocode = $isocode;

        return $this;
    }

    /**
     * Get isocode
     *
     * @return string 
     */
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * Set catalogues
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Catalogues $catalogues
     * @return CataloguesArticles
     */
    public function setCatalogues(\Encyclopedia\LibraryBundle\Entity\Catalogues $catalogues = null)
    {
        $this->catalogues = $catalogues;

        return $this;
    }

    /**
     * Get catalogues
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Catalogues 
     */
    public function getCatalogues()
    {
        return $this->catalogues;
    }
}
