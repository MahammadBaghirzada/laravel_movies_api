<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/multi?api_key=51a1d976631d80ec1b927961b9b00902&query=' . $this->search)
                ->json()['results'];
        }

        //        https://api.themoviedb.org/3/search/multi?api_key=51a1d976631d80ec1b927961b9b00902&query=

//        dump($searchResults);

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(10),
        ]);
    }
}
