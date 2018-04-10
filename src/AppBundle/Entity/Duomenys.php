<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Duomenys
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Duomenys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="miestas", type="string", length=255)
     */
    private $miestas;

    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=255)
     */
    private $apiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="temperatura", type="string", length=255)
     */
    private $temperatura;

    /**
     * @var string
     *
     * @ORM\Column(name="salis", type="string", length=255)
     */
    private $salis;

    /**
     * @var string
     *
     * @ORM\Column(name="debesuotumas", type="string", length=255)
     */
    private $debesuotumas;

    /**
     * @var string
     *
     * @ORM\Column(name="dregnumas", type="string", length=255)
     */
    private $dregnumas;

    /**
     * @var string
     *
     * @ORM\Column(name="slegis", type="string", length=255)
     */
    private $slegis;

    /**
     * @var string
     *
     * @ORM\Column(name="vejas", type="string", length=255)
     */
    private $vejas;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;


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
     * Set miestas
     *
     * @param string $miestas
     *
     * @return Duomenys
     */
    public function setMiestas($miestas)
    {
        $this->miestas = $miestas;

        return $this;
    }

    /**
     * Get miestas
     *
     * @return string
     */
    public function getMiestas()
    {
        return $this->miestas;
    }

    /**
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return Duomenys
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set temperatura
     *
     * @param string $temperatura
     *
     * @return Duomenys
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;

        return $this;
    }

    /**
     * Get temperatura
     *
     * @return string
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * Set salis
     *
     * @param string $salis
     *
     * @return Duomenys
     */
    public function setSalis($salis)
    {
        $this->salis = $salis;

        return $this;
    }

    /**
     * Get salis
     *
     * @return string
     */
    public function getSalis()
    {
        return $this->salis;
    }

    /**
     * Set debesuotumas
     *
     * @param string $debesuotumas
     *
     * @return Duomenys
     */
    public function setDebesuotumas($debesuotumas)
    {
        $this->debesuotumas = $debesuotumas;

        return $this;
    }

    /**
     * Get debesuotumas
     *
     * @return string
     */
    public function getDebesuotumas()
    {
        return $this->debesuotumas;
    }

    /**
     * Set dregnumas
     *
     * @param string $dregnumas
     *
     * @return Duomenys
     */
    public function setDregnumas($dregnumas)
    {
        $this->dregnumas = $dregnumas;

        return $this;
    }

    /**
     * Get dregnumas
     *
     * @return string
     */
    public function getDregnumas()
    {
        return $this->dregnumas;
    }

    /**
     * Set slegis
     *
     * @param string $slegis
     *
     * @return Duomenys
     */
    public function setSlegis($slegis)
    {
        $this->slegis = $slegis;

        return $this;
    }

    /**
     * Get slegis
     *
     * @return string
     */
    public function getSlegis()
    {
        return $this->slegis;
    }

    /**
     * Set vejas
     *
     * @param string $vejas
     *
     * @return Duomenys
     */
    public function setVejas($vejas)
    {
        $this->vejas = $vejas;

        return $this;
    }

    /**
     * Get vejas
     *
     * @return string
     */
    public function getVejas()
    {
        return $this->vejas;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Duomenys
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
}

