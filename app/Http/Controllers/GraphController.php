<?php

namespace App\Http\Controllers;

use App\Services\MicrosoftGraphService;

class GraphController extends Controller
{
    protected $graphService;

    public function __construct(MicrosoftGraphService $graphService)
    {
        $this->graphService = $graphService;
    }

    public function index()
    {
        $users = $this->graphService->getUsers();
        $devices = $this->graphService->getDevices();

        return view('graph.index', compact('users', 'devices'));
    }
}


