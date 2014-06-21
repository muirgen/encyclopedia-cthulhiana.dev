<?php

namespace Encyclopedia\RessourcesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OeuvresAlias
 *
 * @ORM\Table(name="oeuvres_alias", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="id_oeuvre", columns={"id_oeuvre"}), @ORM\Index(name="id_lang", columns={"id_lang"})})
 * @ORM\Entity
 */
class OeuvresAlias
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
     * @var \Oeuvres
     *
     * @ORM\ManyToOne(targetEntity="Oeuvres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     * })
     */
    private $idOeuvre;

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
     * @return OeuvresAlias
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
     * Set idOeuvre
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre
     * @return OeuvresAlias
     */
    public function setIdOeuvre(\Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre = null)
    {
        $this->idOeuvre = $idOeuvre;

        return $this;
    }

    /**
     * Get idOeuvre
     *
     * @return \Encyclopedia\RessourcesBundle\Entity\Oeuvres 
     */
    public function getIdOeuvre()
    {
        return $this->idOeuvre;
    }

    /**
     * Set idLang
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Lang $idLang
     * @return OeuvresAlias
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
