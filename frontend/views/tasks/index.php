<?php

/**
 * @var ActiveDataProvider $dataProvider ;
 */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>
<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>
        <?php echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_list',
            'layout' => "{items}\n<div class='new-task__pagination'>{pager}</div>",
            'itemOptions' => [
                'tag' => 'div',
                'class' => 'new-task__card',
            ],
            'pager' => [
                'maxButtonCount' => 5,
                'activePageCssClass' => 'pagination__item--current',
                'prevPageCssClass' => 'pagination__item',
                'nextPageCssClass' => 'pagination__item',
                'pageCssClass' => 'pagination__item',
                'prevPageLabel' => '',
                'nextPageLabel' => '',
                'options' => [
                    'tag' => 'ul',
                    'class' => 'new-task__pagination-list',
                ]
            ],
            'emptyText' => 'Новых задач нет',
            'emptyTextOptions' => [
                'tag' => 'p'
            ],

        ]);
        ?>
    </div>
</section>
<section class="search-task">
    <div class="search-task__wrapper">
        <form class="search-task__form" name="test" method="post" action="#">
            <fieldset class="search-task__categories">
                <legend>Категории</legend>
                <label class="checkbox__legend">
                    <input class="visually-hidden checkbox__input"
                           type="checkbox" name="" value="" checked>
                    <span>Курьерские услуги</span>
                </label>
                <label class="checkbox__legend">
                    <input class="visually-hidden checkbox__input"
                           type="checkbox" name="" value="" checked>
                    <span>Грузоперевозки</span>
                </label>
                <label class="checkbox__legend">
                    <input class="visually-hidden checkbox__input"
                           type="checkbox" name="" value="">
                    <span>Переводы</span>
                </label>
                <label class="checkbox__legend">
                    <input class="visually-hidden checkbox__input"
                           type="checkbox" name="" value="">
                    <span>Строительство и ремонт</span>
                </label>
                <label class="checkbox__legend">
                    <input class="visually-hidden checkbox__input"
                           type="checkbox" name="" value="">
                    <span>Выгул животных</span>
                </label>
            </fieldset>
            <fieldset class="search-task__categories">
                <legend>Дополнительно</legend>
                <div>
                    <label class="checkbox__legend">
                        <input class="visually-hidden checkbox__input"
                               type="checkbox" name="" value="">
                        <span>Без исполнителя</span>
                    </label>
                </div>
                <div>
                    <label class="checkbox__legend">
                        <input class="visually-hidden checkbox__input" id="7"
                               type="checkbox" name="" value="" checked>
                        <span>Удаленная работа</span>
                    </label>
                </div>
            </fieldset>
            <div class="field-container">
                <label class="search-task__name" for="8">Период</label>
                <select class="multiple-select input" id="8" size="1"
                        name="time[]">
                    <option value="day">За день</option>
                    <option selected value="week">За неделю</option>
                    <option value="month">За месяц</option>
                </select>
            </div>
            <div class="field-container">
                <label class="search-task__name" for="9">Поиск по
                    названию</label>
                <input class="input-middle input" id="9" type="search" name="q"
                       placeholder="">
            </div>
            <button class="button" type="submit">Искать</button>
        </form>
    </div>
</section>