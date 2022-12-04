<?php

namespace App\Components;

class TagsParser extends Parser
{
    /**
     * Парсим урл и возвращаем теги
     * работает с HTML и XML
     *
     * @param string $url
     * @return array
     */
    public function parse(string $url): array
    {
        // Получаем код страницы
        $content = $this->getContent($url);
        $tags = $this->getTags($content);

        return $tags;
    }

    /**
     * Вытаскиваем теги из кода
     *
     * @param string $content
     * @return array
     */
    private function getTags(string $content): array
    {
        // Заносим в массив только теги (открывающие и закрывающие)
        preg_match_all(
            '$</?\\w+((\\s+\\w+(\\s*=\\s*(?:".*?"|\\.*?\\|[^">\\s]+))?)+\\s*|\\s*)/?>$',
            $content,
            $tagsRaw
        );

        foreach ($tagsRaw[0] as $key => $tag) {
            // Нас интересуют только открывающие теги
            // потому что существуют теги без закрывающей пары, например img
            if (strpos($tag, '/')!==1) {
                // Берем только сам тег, без треугольных кавычек и параметров
                $value = str_replace(['<', '>' , '/'], '', strtok($tag, ' '));

                // Запоминает тег, если он уже есть в массиве, инкрементируем счетчик
                $tagsCleared[$value] = isset($tagsCleared[$value]) ? $tagsCleared[$value] + 1 : 1;
            }
            
        }
        // Сортируем массив по счетчику
        arsort($tagsCleared);

        return $tagsCleared;
    }
}