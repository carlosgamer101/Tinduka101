<?php

namespace App\Livewire;

use App\Models\Location;
use Livewire\Component;

class LocationSearch extends Component
{
    public $search = '';

    public function render()
    {
        $locations = Location::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->limit(8)
            ->get();

        return view('livewire.location-search', [
            'locations' => $locations
        ]);
    }
}