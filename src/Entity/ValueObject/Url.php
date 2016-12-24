<?php

namespace Trellis\Entity\ValueObject;

use Trellis\Entity\ValueObjectInterface;
use Trellis\Error\Assert\Assertion;

final class Url implements ValueObjectInterface
{
    const EMPTY = '';

    const DEFAULT_PATH = "/";

    const DEFAULT_SCHEME = "http";

    /**
     * @var Text $user
     */
    private $user;

    /**
     * @var Text $fragment
     */
    private $fragment;

    /**
     * @var Text $host
     */
    private $host;

    /*
     * @var Text $scheme
     */
    private $scheme;

    /**
     * @var Text $query
     */
    private $query;

    /**
     * @var Integer $port
     */
    private $port;

    /**
     * @var Text $path
     */
    private $path;

    /**
     * @var Text $pass
     */
    private $pass;

    /**
     * @param string $url
     */
    public function __construct(string $url = self::EMPTY)
    {
        if ($url !== self::EMPTY) {
            Assertion::url($url);
            $this->host = new Text(parse_url($url, PHP_URL_HOST) ?? "");
            $this->user = new Text(parse_url($url, PHP_URL_USER) ?? "");
            $this->pass = new Text(parse_url($url, PHP_URL_PASS) ?? "");
            $this->scheme = new Text(parse_url($url, PHP_URL_SCHEME) ?? self::DEFAULT_SCHEME);
            $this->query = new Text(parse_url($url, PHP_URL_QUERY) ?? "");
            $this->port = new Integer(parse_url($url, PHP_URL_PORT));
            $this->fragment = new Text(parse_url($url, PHP_URL_FRAGMENT) ?? "");
            $this->path = new Text(parse_url($url, PHP_URL_PATH) ?? self::DEFAULT_PATH);
        } else {
            $this->host = new Text;
            $this->user = new Text;
            $this->pass = new Text;
            $this->scheme = new Text;
            $this->query = new Text;
            $this->port = new Integer;
            $this->fragment = new Text;
            $this->path = new Text;
        }
    }

    /**
     * @param ValueObjectInterface $other_value
     *
     * @return bool
     */
    public function equals(ValueObjectInterface $other_value): bool
    {
        /* @var Url $other_value */
        Assertion::isInstanceOf($other_value, Url::CLASS);
        return $this->host->equals($other_value->getHost())
            && $this->scheme->equals($other_value->getScheme())
            && $this->port->equals($other_value->getPort())
            && $this->user->equals($other_value->getUser())
            && $this->pass->equals($other_value->getPass())
            && $this->query->equals($other_value->getQuery())
            && $this->fragment->equals($other_value->getFragment())
            && $this->path->equals($other_value->getPath());
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->host->isEmpty()
            && $this->scheme->isEmpty()
            && $this->port->isEmpty()
            && $this->user->isEmpty()
            && $this->pass->isEmpty()
            && $this->query->isEmpty()
            && $this->fragment->isEmpty()
            && $this->path->isEmpty();
    }

    /**
     * @return string
     */
    public function toNative(): string
    {
        if ($this->isEmpty()) {
            return self::EMPTY;
        }
        $user = '';
        if (!$this->getUser()->isEmpty() && !$this->getPass()->isEmpty()) {
            $user = sprintf('%s:%s@', $this->getUser(), $this->getPass());
        } elseif (!$this->getUser()->isEmpty()) {
            $user = sprintf('%s@', $this->getUser());
        }
        $port = '';
        if (!$this->getPort()->isEmpty()) {
            $port = sprintf(':%d', $this->getPort()->toNative());
        }
        return sprintf(
            '%s://%s%s%s%s%s%s',
            $this->getScheme(),
            $user,
            $this->getHost(),
            $port,
            $this->getPath(),
            $this->getQuery(),
            $this->getFragment()
        );
    }

    /**
     * @return Text
     */
    public function getUser(): Text
    {
        return $this->user;
    }

    /**
     * @return Text
     */
    public function getPath(): Text
    {
        return $this->path;
    }

    /**
     * @return Integer
     */
    public function getPort(): Integer
    {
        return $this->port;
    }

    /**
     * @return Text
     */
    public function getFragment(): Text
    {
        return $this->fragment;
    }

    /**
     * @return Text
     */
    public function getHost(): Text
    {
        return $this->host;
    }

    /**
     * @return Text
     */
    public function getQuery(): Text
    {
        return $this->query;
    }

    /**
     * @return Text
     */
    public function getScheme(): Text
    {
        return $this->scheme;
    }

    /**
     * @return Text
     */
    public function getPass(): Text
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->isEmpty() ? self::EMPTY : $this->toNative();
    }
}