<?php

declare(strict_types=1);

namespace frontend\controllers;

use Components\Constants\UserConstants;
use Components\Routes\Route;
use frontend\models\City;
use frontend\models\User;
use frontend\models\UserSettings;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;

final class RegistrationController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionIndex(): string
    {
        $user = new User();
        $cities = City::getCitiesForOptionsList();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());
            if ($user->validate()) {
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
                $user->role = UserConstants::USER_ROLE_CUSTOMER;
                $user->save();
                $userSettings = new UserSettings();
                $userSettings->user_id = $user->id;
                $userSettings->is_message_ntf_enabled = 1;
                $userSettings->is_action_ntf_enabled = 1;
                $userSettings->is_new_review_ntf_enabled = 1;
                $userSettings->is_hidden = 0;
                $userSettings->is_active = 1;
                $userSettings->save();
                $this->redirect(Route::getTasks());
            }
        }

        return $this->render('index', compact('user', 'cities'));
    }
}