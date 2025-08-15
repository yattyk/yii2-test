<?php
namespace app\controllers;

use app\models\KnowledgeBase;
use app\models\Subtopic;
use Yii;
use yii\web\Controller;

class KnowledgeController extends Controller
{
    public function actionIndex(int $topic = null, int $subtopic = null)
    {
        // 1) Определяем выбранную тему (или по умолчанию Тема 1)
        $selectedTopic = KnowledgeBase::findTopicById((int)$topic) ?? KnowledgeBase::getTopics()[0];

        // 2) Получаем список подтем по выбранной теме
        $subtopics = KnowledgeBase::getSubtopicsByTopicId($selectedTopic->id);

        // 3) Определяем выбранную подтему
        $selectedSubtopic = null;
        if ($subtopic !== null) {
            $maybe = KnowledgeBase::findSubtopicById((int)$subtopic);
            // подтема должна принадлежать выбранной теме, иначе сбрасываем
            if ($maybe instanceof Subtopic && $maybe->topicId === $selectedTopic->id) {
                $selectedSubtopic = $maybe;
            }
        }
        if (!$selectedSubtopic) {
            // при первой загрузке, а также при смене темы — выбираем первую подтему
            $selectedSubtopic = KnowledgeBase::getFirstSubtopicForTopic($selectedTopic->id);
        }

        // 4) Формируем содержимое
        $content = KnowledgeBase::getContentForSubtopic($selectedSubtopic);

        return $this->render('index', [
            'topics'            => KnowledgeBase::getTopics(),
            'subtopics'         => $subtopics,
            'selectedTopicId'   => $selectedTopic->id,
            'selectedSubtopicId'=> $selectedSubtopic->id,
            'content'           => $content,
        ]);
    }
}
