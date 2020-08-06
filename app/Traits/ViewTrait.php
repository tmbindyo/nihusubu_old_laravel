<?php

namespace App\Traits;

use App\Invoice;
use App\View;
use Auth;
use App\Loan;
use App\Institution;
use http\Client\Response;
use PhpOption\None;

trait ViewTrait
{

    use PasswordTrait;
    public function setCookie($request) {
        $value = $this->generateString();
        $cookie = cookie()->forever('name', $value);
        return $cookie;
    }

    public function getCookie($request) {
        // check if set
        if (isset($request->cookie['nihusubu_session'])){
            return $request->cookie('nihusubu_session');
        }else{
            // set cookie
            return $request->cookie('nihusubu_session');
            $value = $this->generateString();
            return $request->cookie()->forever($value);
        }
    }

    public function trackView($request,$view_id)
    {

        //        return $request->fullUrl();
//        return $request->userAgent();


        // Save view
        $view = new View();
        try{
            $cookie = $this->getCookie($request);
            $exception = null;
        }catch (Exception $e) {
            $cookie = null;
            $exception = $e->getMessage();
        }

        $view->cookie = $cookie;
        $view->exception = $exception;
        $view->route = $request->fullUrl();
        $view->view_id = $view_id;
        $view->ip = request()->ip();
        $view->save();
        return $view->id;

    }

}
