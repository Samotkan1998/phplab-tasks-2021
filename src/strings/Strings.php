<?php

namespace strings;

class Strings implements StringsInterface
{

    /**
     * Transforms string into camel
     *
     * @param string $input
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string
    {
        $arrayWords = explode("_", $input);
        $camelString = '';

        foreach ($arrayWords as $word) {
            $camelString .= ucfirst($word);
        }

        return lcfirst($camelString);
    }

    /**
     * Mirrors each word
     *
     * @param string $input
     * @return string
     */
    public function mirrorMultibyteString(string $input): string
    {
        $input = iconv('utf-8', 'windows-1251', $input);
        $arrayWords = explode(" ", $input);
        $arrayMirrored = [];

        for ($i = 0; $i < count($arrayWords); $i++) {
            array_push(
                $arrayMirrored,
                iconv(
                    'windows-1251',
                    'utf-8',
                    strrev($arrayWords[$i])
                )
            );
        }

        return implode(" ", $arrayMirrored);
    }

    /**
     * Gets band name
     *
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        $arrayChars = str_split($noun);

        return ($arrayChars[strlen($noun) - 1] === $arrayChars[0])
            ? ucfirst($noun . substr($noun, 1))
            : 'The ' . ucfirst($noun);
    }
}
