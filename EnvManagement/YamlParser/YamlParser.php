<?php

/**
 * This class is responsible to parse the env.yaml file
 *
 */

class YamlParser
{
    /**
     * @param $content
     * @return array
     */
    public static function parse(?string $content)
    {

        $yaml_array = [];

        if (!$content)
            return $yaml_array;

        $content = preg_replace("#[\n]+#","\n", $content);

        $content = trim($content);

        $content = preg_replace("#(\#)#","////", $content);

        $content = preg_replace("#[\n]#","#", $content);

        $lines = explode("#", $content);

        foreach ($lines as $line){
            if (preg_match("#[/]{4,}#", $line))
                continue;

            $line = explode(":", $line);
            if (count($line) === 2 && trim($line[1] !== "null") && trim($line[1]) !== null)
                $yaml_array[trim($line[0])] = trim($line[1]);
        }

        return $yaml_array;
    }
}