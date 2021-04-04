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


final class CreateClassOptions
{
    private string $name;
    private string $module;

    private string $className;
    private string $namespace;

    public function __construct(string $name, string $module)
    {
        $this->name = $name;
        $this->module = $module;
    }

    public function setClassName(string ...$params): self
    {
        $this->className = implode('', $params);
        return $this;
    }

    public function setNamespace(string ...$params): self
    {
        $this->namespace = implode('\\', $params);
        return $this;
    }

    /**
     * @return string
     */
    public function className(): string
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function namespace(): string
    {
        return $this->namespace;
    }

}
