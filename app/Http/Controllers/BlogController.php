<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    protected $layout = 'layouts.main';
    
    /**
     * Muestra el índice del blog
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $entries = Cache::store('file')->get('blog.entries');

        if ($entries) return view('blog.index', ['entries' => $entries]);

        $entries = [];
        $filePaths  = glob(resource_path() . '/views/blog/entries/*.php');
        foreach ($filePaths as $filePach) {
            if (!is_file($filePach)) continue;
            
            $entry = [];
            $fileName = basename($filePach, '.md.blade.php');
            $viewName = 'blog.entries.' . $fileName;

            $sections = view($viewName)->renderSections();

            $entry['slug'] = $fileName;
            $entry['title'] = !empty($sections['title']) ? $sections['title'] : '';
            $entry['published'] = !empty($sections['published']) ? $sections['published'] : '';
            $entry['description'] = !empty($sections['description']) ? $sections['description']: $sections['title'];
            $entries[] = $entry;
        }


        uasort($entries, function($a, $b) {
            return $a['published'] < $b['published'];
        });

        Cache::store('file')->put('blog.entries', $entries);
        return view('blog.index', ['entries' => $entries]);
    }


    /**
     * Muestra una entrada del blog
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $routeParams = request()->route()->parameters();

        if (!isset($routeParams['slug'])) abort(404);

        $viewName = 'blog.entries.' . $routeParams['slug'];


        if (!view()->exists($viewName)) abort(404);

        return view('blog.show',
            [
                'viewName' => $viewName,
            ]
        );

    }
}
