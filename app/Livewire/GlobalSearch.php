<?php

// app/Livewire/GlobalSearch.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Empleado;

class GlobalSearch extends Component
{
    public $search = '';
    public $searchResults = [];
    public $showResults = false;

    public function updating($property, $value)
    {
        if ($property === 'search') {
            $this->searchResults = [];
            $this->showResults = false;
        }
    }

    public function updated($property)
    {
        if ($property === 'search') {
            if (strlen($this->search) >= 2) {
                $empleados = Empleado::where('name', 'like', "%{$this->search}%")
                    ->orWhere('no_empleado', 'like', "%{$this->search}%")
                    ->orWhere('puesto', 'like', "%{$this->search}%")
                    ->orWhere('ad', 'like', "%{$this->search}%")
                    ->take(5)
                    ->get();

                $this->searchResults = $empleados->map(function ($empleado) {
                    return [
                        'title' => $empleado->name,
                        'subtitle' => $empleado->puesto,
                        'no_empleado' => $empleado->no_empleado,
                        'url' => route('assignment.show', $empleado),
                        'type' => 'Empleado'
                    ];
                })->toArray();

                $this->showResults = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.global-search');
    }
}