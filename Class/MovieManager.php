<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

class MovieManager
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param Movie $movie
     * @return bool|Movie
     */
    public function add(Movie $movie) {
        $sql = 'INSERT INTO movie (id, title, director, actors) VALUES (NULL, :title, :director, :actors)';
        $prepare = $this->pdo->prepare($sql);
        $query = $prepare->execute(array(
            'title'     => $movie->getTitle(),
            'director'  => $movie->getDirector(),
            'actors'    => serialize($movie->getActors()),
        ));
        if ($query) {
            $movie->setId($this->pdo->lastInsertId());
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function findAll() {
        $sql = "SELECT * FROM movie";
        $query = $this->pdo->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $attributes) {
            $movies[] = new Movie($attributes);
        }
        return $movies;
    }

    /**
     * @param $id
     * @return bool|Movie
     */
    public function find($id) {
        $sql = "SELECT * FROM movie WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute(array(
            'id' => $id,
        ));
        $attributes = $prepare->fetch(PDO::FETCH_ASSOC);
        if ($attributes)
            return new Movie($attributes);
        else
            return false;
    }

    /**
     * @param Movie $movie
     * @return bool
     */
    public function update(Movie $movie) {
        $sql = "UPDATE movie SET title = :title, director = :director, actors = :actors WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        return $prepare->execute(array(
            'id'        => $movie->getId(),
            'title'     => $movie->getTitle(),
            'director'  => $movie->getDirector(),
            'actors'    => $movie->getActors(),
        ));
    }

    /**
     * @param $parameter
     * @return PDOStatement
     */
    public function delete($parameter) {
        if ($parameter instanceof Movie) {
            $id = $parameter->getId();
        } else {
            $id = (int) $parameter;
        }
        $sql = "DELETE FROM movie WHERE id = ".$this->pdo->quote($id);
        return $this->pdo->query($sql);
    }
}