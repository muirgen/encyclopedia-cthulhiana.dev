<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CataloguesAlias
 *
 * @ORM\Table(name="catalogues_alias", indexes={@ORM\Index(name="id_catalogue", columns={"id_catalogue"}), @ORM\Index(name="id_lang", columns={"id_lang"})})
 * @ORM\Entity
 */
class CataloguesAlias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=false)
     */
    private $note;

    /**
     * @var \Catalogues
     *
     * @ORM\ManyToOne(targetEntity="Catalogues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_catalogue", referencedColumnName="id")
     * })
     */
    private $idCatalogue;

    /**
     * @var \Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     * })
     */
    private $idLang;



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
     * Set name
     *
     * @param string $name
     * @return CataloguesAlias
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CataloguesAlias
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return CataloguesAlias
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set idCatalogue
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Catalogues $idCatalogue
     * @return CataloguesAlias
     */
    public function setIdCatalogue(\Encyclopedia\RessourcesBundle\Entity\Catalogues $idCatalogue = null)
    {
        $this->idCatalogue = $idCatalogue;

        return $this;
    }

    /**
     * Get idCatalogue
     *
     * @return \Encyclopedia\RessourcesBundle\Entity\Catalogues 
     */
    public function getIdCatalogue()
    {
        return $this->idCatalogue;
    }

    /**
     * Set idLang
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Lang $idLang
     * @return CataloguesAlias
     */
    public function setIdLang(\Encyclopedia\RessourcesBundle\Entity\Lang $idLang = null)
    {
        $this->idLang = $idLang;

        return $this;
    }

    /**
     * Get idLang
     *
     * @return \Encyclopedia\RessourcesBundle\Entity\Lang 
     */
    public function getIdLang()
    {
        return $this->idLang;
    }
}
