<?php
/**
 * Отображение для ./themes/default/views/news/news/news.php:
 *
 * @category YupeView
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     http://yupe.ru
 *
 * @var $this NewsController
 * @var $model News
 **/
?>
<?php
$this->title = $model->title;
$this->description = $model->description;
$this->keywords = $model->keywords;
?>

<?php
$this->breadcrumbs = [
    Yii::t('NewsModule.news', 'News') => ['/news/news/index'],
    $model->title
];
?>

<div class="singlenews__title">
    <h2 class="text">Новости</h2>
</div>
<section class = "typography singlenews__typography">
    <h1><?= CHtml::encode($model->title); ?></h1>
    <hr>
    <?php if ($model->image): ?>
        <?= CHtml::image($model->getImageUrl(), $model->title); ?>
    <?php endif; ?>
    <?= $model->full_text; ?>
</section>