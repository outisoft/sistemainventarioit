<?php

// app/Livewire/GlobalSearch.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Equipo;
use App\Models\Complement;
use App\Models\AccessPoint;
use App\Models\Swittch;
use App\Models\Tpv;
use App\Models\License;
use App\Models\Lease;
use Illuminate\Support\Collection;

class GlobalSearch extends Component
{
    public $search = '';
    public $results = [];
    public $showResults = false;

    protected array $searchConfigs = [];

    public function boot()
    {
        $this->initializeSearchConfigs();
    }

    protected function initializeSearchConfigs()
    {
        $this->searchConfigs = [
            'equipment' => [
                'model' => Equipo::class,
                'title' => 'Equipments',
                'icon' => 'bx bx-laptop',
                'searchFields' => ['marca', 'model', 'serial', 'ip', 'name'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->name,
                        'subtitle' => "Type: {$item->tipo->name} | Serial: {$item->serial} | IP: {$item->ip}"
                    ];
                },
                'limit' => 5,
                'route' => 'details'
            ],
            'employees' => [
                'model' => Employee::class,
                'title' => 'Employees',
                'icon' => 'bx bx-user',
                'searchFields' => ['no_employee', 'name'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->name,
                        'subtitle' => "No. Employee: {$item->no_employee}"
                    ];
                },
                'limit' => 5,
                'route' => 'employees.show'
            ],
            'positions' => [
                'model' => Position::class,
                'title' => 'Positions',
                'icon' => 'bx bx-briefcase',
                'searchFields' => ['position', 'email', 'ad'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->position,
                        'subtitle' => "Email: {$item->email} | AD: {$item->ad}"
                    ];
                },
                'limit' => 5,
                'route' => 'positions.show'
            ],
            'complements' => [
                'model' => Complement::class,
                'title' => 'Complements',
                'icon' => 'bx bxs-keyboard',
                'searchFields' => ['brand', 'model', 'serial'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->brand,
                        'subtitle' => "Model: {$item->model} | Serial: {$item->serial}"
                    ];
                },
                'limit' => 5,
                'route' => 'complements.show'
            ],
            'access-points' => [
                'model' => AccessPoint::class,
                'title' => 'Access Points',
                'icon' => 'bx bx-broadcast',
                'searchFields' => ['name', 'marca', 'model', 'serial', 'mac', 'ip'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->name,
                        'subtitle' => "Model: {$item->model} | Serial: {$item->serial} | Ip: {$item->ip}"
                    ];
                },
                'limit' => 5,
                'route' => 'access-points.show'
            ],
            'switches' => [
                'model' => Swittch::class,
                'title' => 'Switch',
                'icon' => 'bx bx-server',
                'searchFields' => ['name', 'marca', 'model', 'serial', 'mac', 'ip'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->name,
                        'subtitle' => "Model: {$item->model} | Serial: {$item->serial} | Ip: {$item->ip}"
                    ];
                },
                'limit' => 5,
                'route' => 'switches.show'
            ],
            'tpvs' => [
                'model' => Tpv::class,
                'title' => 'Tpvs',
                'icon' => 'bx bx-tv',
                'searchFields' => ['equipment', 'brand', 'model', 'no_serial', 'name', 'ip'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->name,
                        'subtitle' => "Model: {$item->model} | Serial: {$item->no_serial} | Ip: {$item->ip}"
                    ];
                },
                'limit' => 5,
                'route' => 'tpvs.show'
            ],
            'licenses' => [
                'model' => License::class,
                'title' => 'Licenses',
                'icon' => 'bx bx-key',
                'searchFields' => ['type', 'key'],
                'displayCallback' => function($item) {
                    return [
                        'title' => $item->type,
                        'subtitle' => "Type: {$item->type} | Key/Email: {$item->key} "
                    ];
                },
                'limit' => 5,
                'route' => 'licenses.show'
            ],
            'lease' => [
                'model' => Lease::class,
                'title' => 'Leases',
                'icon' => 'bx bx-clipboard',
                'searchFields' => ['lease'],
                'displayCallback' => function($item) {
                    return [
                        'title' => 'Lease',
                        'subtitle' => "Lease: {$item->lease} | End Date: {$item->end_date} "
                    ];
                },
                'limit' => 5,
                'route' => 'lease.show'
            ]
        ];
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            foreach ($this->searchConfigs as $key => $config) {
                $this->results[$key] = $this->searchInModel($config);
            }
            $this->showResults = true;
        } else {
            $this->reset('results', 'showResults');
        }
    }

    protected function searchInModel($config)
    {
        $query = $config['model']::query();
        
        // Primera condición
        $query->where(function($q) use ($config) {
            foreach ($config['searchFields'] as $index => $field) {
                if ($index === 0) {
                    $q->where($field, 'like', '%' . $this->search . '%');
                } else {
                    $q->orWhere($field, 'like', '%' . $this->search . '%');
                }
            }
        });

        return $query->take($config['limit'])
            ->get()
            ->map(function ($item) use ($config) {
                $displayInfo = ($config['displayCallback'])($item);
                return [
                    'type' => $config['title'],
                    'title' => $displayInfo['title'],
                    'subtitle' => $displayInfo['subtitle'],
                    'url' => route($config['route'], $item->id),
                    'icon' => $config['icon']
                ];
            });
    }

    public function render()
    {
        return view('livewire.global-search', [
            'searchConfigs' => $this->searchConfigs
        ]);
    }
}