<?php
/** @var \yii\web\View $this */
/** @var \app\models\Topic[] $topics */
/** @var \app\models\Subtopic[] $subtopics */
/** @var int $selectedTopicId */
/** @var int $selectedSubtopicId */
/** @var string $content */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'База знаний (демо)';
$this->registerCss(<<<CSS
.kb-wrap {
  display: grid;
  grid-template-columns: 1fr 1fr 2fr;
  gap: 16px;
}
.kb-card {
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  padding: 12px;
  background: #fff;
  box-shadow: 0 1px 2px rgba(0,0,0,.04);
  min-height: 320px;
}
.kb-title {
  font-size: 18px;
  font-weight: 600;
  margin: 0 0 10px 0;
}
.kb-list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.kb-item a {
  display: block;
  padding: 10px 12px;
  text-decoration: none;
  border-radius: 8px;
  border: 1px solid transparent;
}
.kb-item a:hover {
  background: #f3f4f6;
}
.kb-item.selected a {
  background: #fff59d;
  border-color: #f6e05e;
}
.kb-content {
  border: 1px dashed #e5e7eb;
  border-radius: 10px;
  padding: 16px;
  min-height: 280px;
  display: flex;
  align-items: center;
  font-size: 16px;
}
.small-muted {
  color: #6b7280;
  font-size: 12px;
  margin-top: 6px;
}
CSS);
?>
<div class="kb-wrap">
  <div class="kb-card">
    <div class="kb-title">Тема</div>
    <ul class="kb-list">
      <?php foreach ($topics as $t): ?>
        <?php
          $url = Url::to(['knowledge/index', 'topic' => $t->id]);
          $isSelected = ($t->id === $selectedTopicId);
        ?>
        <li class="kb-item <?= $isSelected ? 'selected' : '' ?>">
          <a href="<?= Html::encode($url) ?>"><?= Html::encode($t->name) ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="small-muted">Клик по теме сбрасывает подтему на первую.</div>
  </div>

  <div class="kb-card">
    <div class="kb-title">Подтема</div>
    <ul class="kb-list">
      <?php foreach ($subtopics as $s): ?>
        <?php
          $url = Url::to(['knowledge/index', 'topic' => $selectedTopicId, 'subtopic' => $s->id]);
          $isSelected = ($s->id === $selectedSubtopicId);
        ?>
        <li class="kb-item <?= $isSelected ? 'selected' : '' ?>">
          <a href="<?= Html::encode($url) ?>"><?= Html::encode($s->name) ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="kb-card">
    <div class="kb-title">Содержимое</div>
    <div class="kb-content">
      <?= Html::encode($content) ?>
    </div>
    <div class="small-muted">Показывает текст, привязанный к выбранной подтеме.</div>
  </div>
</div>
