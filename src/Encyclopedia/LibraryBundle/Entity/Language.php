<?php
namespace Encyclopedia\LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 *
 * @ORM\Table(name="tf_language", indexes={@ORM\Index(name="iso_code", columns={"iso_code"})})
 * @ORM\Entity
 */
class Language {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true} )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="str_language", type="string", length=50, nullable=false)
     */
    private $language;
    
    /**
     * @var string
     *
     * @ORM\Column(name="str_iso_code", type="string", length=2, nullable=false)
     */
    private $isoCode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="str_language_code", type="string", length=5, nullable=false)
     */
    private $languageCode;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="public", type="boolean", length=1, nullable=false, options={"default":0})
     */
    private $public;
    

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
     * Set language
     *
     * @param string $language
     * @return Language
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set isoCode
     *
     * @param string $isoCode
     * @return Language
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string 
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set languageCode
     *
     * @param string $languageCode
     * @return Language
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * Get languageCode
     *
     * @return string 
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * Set public
     *
     * @param boolean $public
     * @return Language
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean 
     */
    public function getPublic()
    {
        return $this->public;
    }
}
