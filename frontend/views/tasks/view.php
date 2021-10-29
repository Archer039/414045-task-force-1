<?php

use Components\Constants\UserConstants;
use Components\Constants\ActionConstants;
use Components\Routes\Route;
use Components\Tasks\TaskService;
use frontend\models\Task;
use frontend\models\TaskCompleteForm;
use frontend\models\User;
use frontend\models\Response;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/**
 * @var Task $task ;
 * @var TaskCompleteForm $taskCompleteForm ;
 * @var array $possibleTaskActions ;
 * @var array $taskAttachments ;
 * @var User $customer ;
 * @var Response $response ;
 * @var bool $isUserSentResponse ;
 * @var ActiveDataProvider $dataProvider ;
 * @var int $countCustomerTasks ;
 * @var int $countResponses ;
 * @var string $city ;
 * @var int $categoryId ;
 * @var string $categoryName ;
 * @var string $categoryClassName ;
 */

?>

<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">
                    <h1><?= $task->title ?></h1>
                    <span>Размещено в категории
                                    <a href="<?= Route::getTasks($categoryId) ?>"
                                       class="link-regular"><?= $categoryName ?></a>
                                    25 минут назад</span>
                </div>
                <b class="new-task__price new-task__price--<?= $categoryClassName ?> content-view-price"><?= $task->price ?>
                    <b>
                        ₽</b></b>
                <div class="new-task__icon new-task__icon--<?= $categoryClassName ?> content-view-icon"></div>
            </div>
            <div class="content-view__description">
                <h3 class="content-view__h3">Общее описание</h3>
                <p>
                    <?= $task->description ?>
                </p>
            </div>
            <div class="content-view__attach">
                <h3 class="content-view__h3">Вложения</h3>
                <?= (!$task->taskAttachments) ? 'Прикреплённых файлов нет' : '' ?>
                <?php foreach ($task->taskAttachments as $attachment): ?>
                    <a href="<?= $attachment->file_src ?>"><?= $attachment->file_name ?></a>
                <?php endforeach; ?>
            </div>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                         alt="Москва, Новый арбат, 23 к. 1"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town">Москва</span><br>
                        <span><?= $task->address ?></span>
                        <p><?= $task->address_comment ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-view__action-buttons">
            <?php foreach ($possibleTaskActions as $action): ?>
                <?php $actionName = $action::getActionName() ?>
                <button
                        class=" button button__big-color <?= TaskService::getTaskActionButtonClassName($actionName) ?> open-modal"
                        type="button"
                        data-for="<?= TaskService::getTaskActionDataForClassName($actionName) ?>"><?= $action::getActionNameForUser($task) ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if (Yii::$app->user->id === $task->customer_id || $isUserSentResponse): ?>
        <div class="content-view__feedback">
            <h2>Отклики <span><?= !$isUserSentResponse ? '(' . $countResponses . ')' : '' ?></span></h2>
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => 'responsesList',
                'layout' => "{items}{pager}",
                'options' => [
                    'class' => 'content-view__feedback-wrapper'
                ],
                'itemOptions' => [
                    'class' => 'content-view__feedback-card',
                ],
                'emptyText' => 'Откликов на выбранную задачу нет'
            ]) ?>
        </div>
    <?php endif; ?>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <img src="<?= $customer->avatar_src ?? UserConstants::USER_DEFAULT_AVATAR_SRC ?>" width="62" height="62"
                     alt="Аватар заказчика">
                <div class="profile-mini__name five-stars__rate">
                    <p><?= $customer->name ?></p>
                </div>
            </div>
            <p class="info-customer"><span><?= $countCustomerTasks ?> заданий</span><span
                        class="last-">2 года на сайте</span></p>
            <a href="#" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
    <div id="chat-container">
        <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
        <chat class="connect-desk__chat"></chat>
    </div>
</section>
<?= $this->render('modalResponse', compact(['response'])) ?>
<?= $this->render('modalComplete', compact(['taskCompleteForm'])) ?>
<?= $this->render('modalRefuse', compact(['task'])) ?>
