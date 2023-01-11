<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\ShowViewModel;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $top_rated = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/top_rated?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/top_rated?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=30dd77eaf6e79fc4bc512183b1d9de88')
            ->json()['genres'];

//        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
//            return [$genre['id'] => $genre['name']];
//        });

//        dump($nowPlayingMovies);

//        return view('movie.index', [
//            'popularMovies' => $popularMovies,
//            'nowPlayingMovies' => $nowPlayingMovies,
//            'genres' => $genres,
//        ]);

        $viewModel = new MoviesViewModel(
            $top_rated,
            $nowPlayingMovies,
            $genres,
        );

        return view('movies.index', $viewModel);
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?api_key=30dd77eaf6e79fc4bc512183b1d9de88&append_to_response=credits,videos,images')
            ->json();

//        dump($movie);

//        return view('movie.show', [
//            'movie' => $movie,
//        ]);

        $viewModel = new ShowViewModel($movie);

        return view('movies.show', $viewModel);
    }
}
