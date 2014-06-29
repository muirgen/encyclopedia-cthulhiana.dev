<?php

namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OeuvresAlias
 *
 * @ORM\Table(name="oeuvres_alias")
 * @ORM\Entity
 * 
 */
class OeuvresAlias {
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Oeuvres", inversedBy="alias")
     * @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     */
    private $oeuvres;
    
    /**
     * @var \Lang
     * 
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     */
    protected $languages;
    
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
     * Set oeuvres
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres
     * @return OeuvresAlias
     */
    public function setOeuvres(\Encyclopedia\LibraryBundle\Entity\Oeuvres $oeuvres = null)
    {
        $this->oeuvres = $oeuvres;

        return $this;
    }

    /**
     * Get oeuvres
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Oeuvres 
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }

    /**
     * Set languages
     *
     * @param \Encyclopedia\LibraryBundle\Entity\Lang $languages
     * @return OeuvresAlias
     */
    public function setLanguages(\Encyclopedia\LibraryBundle\Entity\Lang $languages = null)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return \Encyclopedia\LibraryBundle\Entity\Lang 
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}
