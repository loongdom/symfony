<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @experimental in 4.3
 */
class RawMessage
{
    private $message;

    /**
     * @param iterable|string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function toString(): string
    {
        if (\is_string($this->message)) {
            return $this->message;
        }

        return $this->message = implode('', iterator_to_array($this->message));
    }

    public function toIterable(): iterable
    {
        if (\is_string($this->message)) {
            yield $this->message;

            return;
        }

        $message = '';
        foreach ($this->message as $chunk) {
            $message .= $chunk;
            yield $chunk;
        }
        $this->message = $message;
    }
}
