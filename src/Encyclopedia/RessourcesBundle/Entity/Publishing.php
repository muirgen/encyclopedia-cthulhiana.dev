<?php

namespace Encyclopedia\RessourcesBundle\Entity;

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
    private $idLang;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oeuvres", mappedBy="idPublishing")
     */
    private $idOeuvre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idOeuvre = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idLang
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Lang $idLang
     * @return Publishing
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

    /**
     * Add idOeuvre
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre
     * @return Publishing
     */
    public function addIdOeuvre(\Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre)
    {
        $this->idOeuvre[] = $idOeuvre;

        return $this;
    }

    /**
     * Remove idOeuvre
     *
     * @param \Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre
     */
    public function removeIdOeuvre(\Encyclopedia\RessourcesBundle\Entity\Oeuvres $idOeuvre)
    {
        $this->idOeuvre->removeElement($idOeuvre);
    }

    /**
     * Get idOeuvre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdOeuvre()
    {
        return $this->idOeuvre;
    }
}
