<?php

namespace App\Components;

class Parser 
{
    /**
     * Получаем содержимое страницы
     *
     * @param string $url
     * @return string
     */
    protected function getContent(string $url): string
    {
        $content = file_get_contents($url);
        return $content;
    }
}