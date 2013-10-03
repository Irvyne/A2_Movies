<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

class Movie extends BaseHydrate
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $director;

    /**
     * @var array
     */
    protected $actors;

    public function __construct(array $array = null) {
        if (null !== $array)
            $this->hydrate($array);
    }

    /**
     * @param array $actors
     */
    public function setActors($actors)
    {
        if (!is_array($actors))
            $actors = unserialize($actors);
        if (is_array($actors))
            $this->actors = $actors;
    }

    /**
     * @return array
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param $actor
     * @return array
     */
    public function addActor($actor)
    {
        if (!in_array($actor, $this->actors))
            $this->actors[] = $actor;
        return $this->getActors();
    }

    /**
     * @param $actor
     * @return bool
     */
    public function removeActor($actor)
    {
        foreach ($this->actors as $key => $value) {
            if ($actor === $value) {
                unset($this->actors[$key]);
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


}