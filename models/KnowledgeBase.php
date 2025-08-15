<?php
namespace app\models;

class KnowledgeBase
{
    /** @return Topic[] */
    public static function getTopics(): array
    {
        return [
            new Topic(1, 'Тема 1'),
            new Topic(2, 'Тема 2'),
        ];
    }

    /** @param int $topicId @return Subtopic[] */
    public static function getSubtopicsByTopicId(int $topicId): array
    {
        if ($topicId === 1) {
            return [
                new Subtopic(11, 1, 'Подтема 1.1'),
                new Subtopic(12, 1, 'Подтема 1.2'),
                new Subtopic(13, 1, 'Подтема 1.3'),
            ];
        }
        if ($topicId === 2) {
            return [
                new Subtopic(21, 2, 'Подтема 2.1'),
                new Subtopic(22, 2, 'Подтема 2.2'),
                new Subtopic(23, 2, 'Подтема 2.3'),
            ];
        }
        return self::getSubtopicsByTopicId(1);
    }

    public static function findTopicById(int $id): ?Topic
    {
        foreach (self::getTopics() as $t) {
            if ($t->id === $id) {
                return $t;
            }
        }
        return null;
    }

    public static function findSubtopicById(int $id): ?Subtopic
    {
        foreach (self::getTopics() as $topic) {
            foreach (self::getSubtopicsByTopicId($topic->id) as $s) {
                if ($s->id === $id) {
                    return $s;
                }
            }
        }
        return null;
    }

    public static function getFirstSubtopicForTopic(int $topicId): Subtopic
    {
        $list = self::getSubtopicsByTopicId($topicId);
        return $list[0];
    }

    public static function getContentForSubtopic(Subtopic $subtopic): string
    {
        return 'Некий текст, привязанный к ' . $subtopic->name;
    }
}
