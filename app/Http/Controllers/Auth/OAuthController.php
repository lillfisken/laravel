<?php namespace market\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use market\helper\debug;
use market\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use market\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OAuthController extends Controller
{
    public function getFacebook(){
        dd('Get facebook');
    }

    public function postFacebook(){
        dd('post facebook');
    }

    public function getGoogle(){
        dd('Get Google');
    }

    public function postGoogle(){
        dd('post Google');
    }

    public function getTwitter(){
        dd('Get Twitter');
    }

    public function postTwitter(){
        dd('Post Twitter');
    }

    public function getGithub(){
        dd('Get GitHub');
    }

    public function postGithub(){
        dd('Post GitHub');
    }

    public function getElektronikforumet(){
        dd('Get Elektronikforumet');
    }

    public function postElektronikforumet(){
        dd('Post Elektronikforumet');
    }
}