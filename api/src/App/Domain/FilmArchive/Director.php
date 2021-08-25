<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Domain\FilmArchive;


use App\Domain\FilmArchive\Event\DirectorHasBeenCreated;
use App\Domain\FilmArchive\Event\DirectorHasBeenUpdated;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tangram\Domain\Model\Entity;
use Tangram\Domain\Model\Traits\NotifyEvents;
use Tangram\Domain\ValueObject\FullName;

class Director implements Entity
{
    use NotifyEvents;

    private DirectorId $id;
    private FullName $name;
    private Collection $movies;

    public function __construct(FullName $name, ?MovieList $movies = null)
    {
        $movies = $movies ?? MovieList::collect();

        $this->id = new DirectorId();
        $this->movies = new ArrayCollection();
        $this->apply($name, $movies);
        $this->notify(new DirectorHasBeenCreated($this));
    }

    private function apply(FullName $name, ?MovieList $movies = null)
    {
        $this->name = $name;
        $this->movies()
            ->diff($movies)
            ->inserts(fn(Movie $movie) => $this->addMovie($movie))
            ->deletes(fn(Movie $movie) => $this->removeMovie($movie));
    }

    public function update(FullName $name, ?MovieList $movies = null)
    {
        $this->apply($name, $movies);
        $this->notify(new DirectorHasBeenUpdated($this));
    }

    public function id(): DirectorId
    {
        return $this->id;
    }

    /**
     * @return FullName
     */
    public function name(): FullName
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function movies(): MovieList
    {
        return MovieList::collect($this->movies);
    }

    public function addMovie(Movie $movie): self
    {
        if ($this->movies->contains($movie)) {
            return $this;
        }
        $this->movies->add($movie);
        return $this;
    }

    private function removeMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            return $this;
        }
        $this->movies->removeElement($movie);
        return $this;
    }
}
