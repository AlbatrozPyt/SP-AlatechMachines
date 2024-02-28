<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use http\Client;
use Lcobucci\JWT\Token;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use sizeg\jwt\Jwt;

class AuthController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionLogin()
    {
        $login = new LoginForm();

        if ($login->load(\Yii::$app->request->getBodyParams(), '') && $login->login())
        {
            $user = \Yii::$app->user->identity;
            $token = $user->generateToken();


            return ['token' => $token, 'user' => $user];
        }

        return  $login;
    }
}