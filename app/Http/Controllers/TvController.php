<?php

namespace App\Http\Controllers;

use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;

use Illuminate\Support\Facades\Http;

class TvController extends Controller
{

    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json()['results'];

        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json()['genres'];

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    public function show($id)
    {
        $tvshow = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/'.$id.'?api_key=30dd77eaf6e79fc4bc512183b1d9de88&append_to_response=credits,videos,images')
            ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);
    }
}
