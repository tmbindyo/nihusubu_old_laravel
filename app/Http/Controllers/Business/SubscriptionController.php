<?php

namespace App\Http\Controllers\Business;

use App\Traits\InstitutionTrait;
use App\Traits\ReferenceNumberTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    use UserTrait;
    use institutionTrait;
    use ReferenceNumberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
}
