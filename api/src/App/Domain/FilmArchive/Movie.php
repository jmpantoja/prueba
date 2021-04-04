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

use App\Domain\FilmArchive\Builder\MovieInput;
use App\Domain\FilmArchive\Event\MovieHasBeenCreated;
use App\Domain\FilmArchive\Event\MovieHasBeenUpdated;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tangram\Domain\Model\Entity;
use Tangram\Domain\Model\Traits\NotifyEvents;

class Movie implements Entity
{
    use NotifyEvents;

    private MovieId $id;
    private MovieTitle $title;
    private MovieYear $year;
    private Collection $genres;

    public function __construct(
        MovieTitle $title,
        MovieYear $year,
        GenreList $genres = null
    )
    {
        $this->id = new MovieId();
        $this->genres = new ArrayCollection();

        $this->apply($title, $year, $genres);
        $this->notify(new MovieHasBeenCreated($this));
    }

    public function update(MovieTitle $title,
                           MovieYear $year,
                           GenreList $genres = null)
    {
        $this->apply($title, $year, $genres);
        $this->notify(new MovieHasBeenUpdated($this));
    }

    private function apply(MovieTitle $title,
                           MovieYear $year,
                           GenreList $genres = null)
    {
        $this->title = $title;
        $this->year = $year;

        $this->genres()
            ->diff($genres)
            ->inserts(fn(Genre $genre) => $this->addGenre($genre))
            ->deletes(fn(Genre $genre) => $this->removeGenre($genre));
    }

    /**
     * @return MovieId
     */
    public function id(): MovieId
    {
        return $this->id;
    }

    /**
     * @return MovieTitle
     */
    public function title(): MovieTitle
    {
        return $this->title;
    }

    /**
     * @return MovieYear
     */
    public function year(): MovieYear
    {
        return $this->year;
    }

    /**
     * @return GenreList
     */
    public function genres(): GenreList
    {
        return GenreList::collect($this->genres);
    }

    public function addGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            return $this;
        }
        $this->genres->add($genre);
        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            return $this;
        }
        $this->genres->removeElement($genre);
        return $this;
    }

}
