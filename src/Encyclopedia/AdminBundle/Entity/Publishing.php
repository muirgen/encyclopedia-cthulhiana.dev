<?php

namespace Encyclopedia\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publishing
 *
 * @ORM\Table(name="publishing", indexes={@ORM\Index(name="title", columns={"title", "author"}), @ORM\Index(name="id_lang", columns={"id_lang"})})
 * @ORM\Entity
 */
class Publishing
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
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=250, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="editor", type="string", length=250, nullable=false)
     */
    private $editor;

    /**
     * @var string
     *
     * @ORM\Column(name="classification", type="string", length=250, nullable=false)
     */
    private $classification;

    /**
     * @var string
     *
     * @ORM\Column(name="type_number", type="string", length=30, nullable=true)
     */
    private $typeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_number", type="string", length=250, nullable=false)
     */
    private $refNumber;

    /**
     * @var \Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lang", referencedColumnName="id")
     * })
     */
    private $languages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oeuvres", inversedBy="publishing", cascade={"persist","remove"})
     * @ORM\JoinTable(name="oeuvres_publishing",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_publishing", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="id")
     *   }
     * )
     */
    private $oeuvres;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->oeuvres = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return Publishing
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Publishing
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set editor
     *
     * @param string $editor
     * @return Publishing
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor
     *
     * @return string 
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set classification
     *
     * @param string $classification
     * @return Publishing
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;

        return $this;
    }

    /**
     * Get classification
     *
     * @return string 
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Set typeNumber
     *
     * @param string $typeNumber
     * @return Publishing
     */
    public function setTypeNumber($typeNumber)
    {
        $this->typeNumber = $typeNumber;

        return $this;
    }

    /**
     * Get typeNumber
     *
     * @return string 
     */
    public function getTypeNumber()
    {
        return $this->typeNumber;
    }

    /**
     * Set refNumber
     *
     * @param string $refNumber
     * @return Publishing
     */
    public function setRefNumber($refNumber)
    {
        $this->refNumber = $refNumber;

        return $this;
    }

    /**
     * Get refNumber
     *
     * @return string 
     */
    public function getRefNumber()
    {
        return $this->refNumber;
    }

    /**
     * Set languages
     *
     * @param \Encyclopedia\AdminBundle\Entity\Lang $languages
     * @return Publishing
     */
    public function setLanguages(\Encyclopedia\AdminBundle\Entity\Lang $languages = null)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return \Encyclopedia\AdminBundle\Entity\Lang 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Add oeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres
     * @return Publishing
     */
    public function addOeuvres(\Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres[] = $oeuvres;

        return $this;
    }

    /**
     * Remove oeuvres
     *
     * @param \Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres
     */
    public function removeOeuvres(\Encyclopedia\AdminBundle\Entity\Oeuvres $oeuvres)
    {
        $this->oeuvres->removeElement($oeuvres);
    }

    /**
     * Get oeuvres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOeuvres()
    {
        return $this->oeuvres;
    }
}
