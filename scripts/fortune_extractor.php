<?php

use Illuminate\Database\Eloquent\Factories\Factory;

function extractAndSeed(Factory $factory): void
{
    if (!file_exists('/usr/share/fortune')) {
        throw new RuntimeException('Fortune database not found. Make sure you have fortune-mod installed');
    }

    $dir = dir('/usr/share/fortune');

    while (false !== ($entry = $dir->read())) {
        if (substr($entry, -4, 1) != '.') {
            $fortunes = extractFortunes($entry, '/usr/share/fortune');

            foreach ($fortunes as $fortune) {
                $factory->create(['body' => $fortune]);
            }
        }

    }
}

function extractFortunes(string $file, string $parent): array
{
    $path = "$parent/$file";
    echo "extracting {'$path'}...\n";

    if (!file_exists($path)) {
        return [];
    }

    $stream = fopen($path, 'r');
    $fortunes = [];
    $forStr = '';
    $toggle = false;

    while (!feof($stream)) {
        $line = fgets($stream);

        if (trim($line) === '%') {
            if (!$toggle) {
                $toggle = true;
                $line = fgets($stream);
            } else {
                $toggle = false;
            }
        }

        if ($toggle) {
            $forStr .= $line;
        } else {
            $fortunes[] = $forStr;
            $forStr = '';
            $toggle = true;
        }
    }

    fclose($stream);
    return $fortunes;
}
