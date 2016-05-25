<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\UserSearch;

class SiteController extends Controller {
    
    private $api_key = '1eecd9d8d89dc2b317c326d8651d642b';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup','index','about', 'contact'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'search-index','search','search-results','full-photo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }
    public function actionSearchIndex() {
        $userId = Yii::$app->user->identity->id;
        $recentSearches = UserSearch::getRecentSearches($userId);
        
        $model = new \app\models\SearchForm();
        
        return $this->render('search-index',[
            'recentSearches' => $recentSearches,
            'model' =>  $model
        ]);
    }

    public function actionSearch() {
        $keyword = Yii::$app->getRequest()->get('q', null);
        
        if (empty($keyword)) {
            throw new \InvalidArgumentException('Keyword not provided!');
        }
        
        $page = \Yii::$app->getRequest()->get('page', 1);
        if (empty($keyword)) {
            exit;
        }

        $userId = Yii::$app->user->identity->id;
        UserSearch::saveSearch($userId, $keyword);
        
        return $this->render('search', [
            'keyword'   =>  $keyword,
            'page'  =>  $page
        ]);
    }

    public function actionSearchResults() {
        $keyword = \Yii::$app->getRequest()->get('keyword');
        $perPage = 5;
        $page = \Yii::$app->getRequest()->get('page', 1);
        
        $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
        $url.= '&api_key='.$this->api_key;
        $url.= '&tags='.$keyword;
        $url.= '&per_page='.$perPage;
        $url.= '&format=json';
        $url.= '&page='.$page;
        $url.= '&nojsoncallback=1';
        
        $response = json_decode($this->makeRequest($url));
        
        $photo_array = $response->photos->photo;

            
        $page_count = $response->photos->pages;
        
        return $this->renderPartial('search-results', [
            'photos'   =>  $photo_array,
            'page'  =>  $page,
            'keyword'   =>  $keyword,
            'page_count'    =>  $page_count
        ]);
    }
    
    public function actionFullPhoto() {
        $photo_id = \Yii::$app->getRequest()->get('photo_id');
        $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.getSizes';
        $url.= '&api_key='.$this->api_key;
        $url.= '&photo_id='.$photo_id;
        $url.= '&format=json';
        $url.= '&nojsoncallback=1';
        
        $response = json_decode($this->makeRequest($url));
        
        $sizes = $response->sizes->size;
        
        if ($sizes) {
            foreach ($sizes as $size) {
                if ($size->label == 'Original') {
                    $source = $size->source;
                }
            }
        }
        
        
        return $this->renderPartial('full-photo', [
            'photo'    =>  $photo,
            'source'    =>  $source
        ]);
    }
    
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();

        $session = Yii::$app->session;
        if (!empty($session['attributes'])) {
            $model->username = $session['attributes']['first_name'];
            $model->email = $session['attributes']['email'];
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        $renderer = Yii::$app->getRequest()->isAjax ? 'renderPartial' : 'render';
        return $this->$renderer('signup', [
                    'model' => $model,
        ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    private function makeRequest($url, $options = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
    
        if ($options['method'] == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
}
        if (!empty($options['post_fields'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options['post_fields']);  //Post Fields
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



        $server_output = curl_exec($ch);

        curl_close($ch);

        return $server_output;
    }
    

}
