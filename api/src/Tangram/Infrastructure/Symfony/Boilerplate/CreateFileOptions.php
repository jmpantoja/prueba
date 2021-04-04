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

namespace Tangram\Infrastructure\Symfony\Boilerplate;


final class CreateFileOptions
{
    private string $name;
    private string $module;
    private string $fileName;
    private string $target;

    public function __construct(string $name, string $module)
    {
        $this->name = $name;
        $this->module = $module;
    }

    /**
     * @param string ...$pieces
     * @return CreateFileOptions
     */
    public function setFileName(string ...$pieces): self
    {
        $this->fileName = implode('.', $pieces);
        return $this;
    }

    /**
     * @param string ...$directories
     * @return CreateFileOptions
     */
    public function setTarget(string ...$directories): self
    {
        $this->target = implode('/', $directories);
        return $this;
    }

    /**
     * @return string
     */
    public function fileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function target(): string
    {
        return $this->target;
    }
}
