<?php

namespace NameFinder\Readers;

class File implements ReaderInterface
{
    /** @var string */
    protected $filename;

    /** @var array */
    protected $loaded;

    /**
     * File constructor.
     *
     * @param string $filename
     * @param array $loaded
     */
    public function __construct($filename, $loaded = [])
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \InvalidArgumentException('Not a usable file: ' . $filename);
        }
        $this->filename = $filename;
        $this->loaded = $loaded;
    }

    /**
     * Returns a new instance of itself, with its file loaded.
     *
     * @return ReaderInterface
     */
    public function loadAll(): ReaderInterface
    {
        return $this->loadWhere('');
    }

    /**
     * Returns a new instance of itself, with the lines matching the given parameter loaded.
     *
     * @param string $match
     * @return ReaderInterface
     */
    public function loadWhere(string $match): ReaderInterface
    {
        $loaded = [];
        $stream = fopen($this->filename, 'r');
        while (!feof($stream)) {
            $line = rtrim(preg_replace('/\s+/', ' ', fgets($stream)));
            if (!$this->isNotEmptyAndContains(strtolower($line), strtolower(trim($match)))) {
                continue;
            }
            $loaded[] = $line;
        }
        fclose($stream);
        return new File($this->filename, $loaded);
    }

    /**
     * Returns the loaded lines.
     *
     * @return array
     */
    public function getLoaded(): array
    {
        return $this->loaded;
    }

    /**
     * Returns whether the given haystack is not empty, and contains the needle, if given.
     *
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    protected function isNotEmptyAndContains(string $haystack, string $needle = ''): bool
    {
        return $haystack && $haystack !== ' ' && !($needle && strpos($haystack, $needle) === false);
    }
}
