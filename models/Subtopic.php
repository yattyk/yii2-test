<?php
namespace app\models;

class Subtopic
{
    /** @var int */
    public $id;
    /** @var int */
    public $topicId;
    /** @var string */
    public $name;

    public function __construct(int $id, int $topicId, string $name)
    {
        $this->id      = $id;
        $this->topicId = $topicId;
        $this->name    = $name;
    }
}
