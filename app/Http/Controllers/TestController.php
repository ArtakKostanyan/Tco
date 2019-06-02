<?php

namespace App\Http\Controllers;


use Illuminate\Support\Collection;

class TestController extends Controller
{
    public function test()
    {

        $movies = collect([
            [
                'name' => 'Back To The Future',
                'releases' => [1985, 1989, 1990]
            ],
            [
                'name' => 'Fast and Furious',
                'releases' => [2001, 2003, 2006, 2009, 2011, 2013, 2015, 2017]
            ],
            [
                'name' => 'Speed',
                'releases' => [1994]
            ]
        ]);

        $mostReleases = $movies->sortByDesc(function ($movie, $key) {

         dump( count($movie['releases']));
            return count($movie['releases']);
        });

       // $mostReleases->toArray();
        //list of movies in descending order of most releases.



    }

    public function helperCollection()
    {
        $newCollection = collect([1, 2, 3, 4, 5]);
        dd($newCollection);
    }

    /**
     * Create a new collection with a Collection class instance.
     */
    public function classCollection()
    {
        $newCollection = new Collection([1, 2, 3, 4, 5]);
        dd($newCollection->max());
    }
}
