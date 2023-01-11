<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ShowActorViewModel;

use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?api_key=30dd77eaf6e79fc4bc512183b1d9de88&page='.$page)
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('actors.index', $viewModel);
    }

    public function show($id)
    {
        https://api.themoviedb.org/3/person/125025?api_key=51a1d976631d80ec1b927961b9b00902

        $actor = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json();

        $social = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json();

        $viewModel = new ShowActorViewModel($actor, $social, $credits);


        return view('actors.show', $viewModel);
    }
}
