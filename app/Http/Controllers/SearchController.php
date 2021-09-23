<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Seller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function visitorSearch(Request $request)
    {
        $title = 'Search Results - AllAroundBucks';

        if ($request->search_type == 'projects') {

            $projects = Project::where('project_title', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('project_category', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('project_description', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('project_category', 'LIKE', '%'.$request->search_query.'%')
                                ->orderBy('project_id', 'DESC')
                                // ->paginate(10)
                                ->get();



            return view('search.visitorsearch.projects-search-result', compact('projects', 'title'));
        }
        elseif ($request->search_type == 'talents') {

            $sellers = Seller::where('sellers.seller_username', 'LIKE', '%'.$request->search_query.'%')
                                ->join('users', 'users.user_id', '=', 'sellers.user_id')
                                ->orWhere('sellers.skills', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('users.profession', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('users.bio', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('users.name', 'LIKE', '%'.$request->search_query.'%')
                                ->select('sellers.*', 'users.name', 'users.profession',
                                        'users.bio', 'users.profile_img')
                                ->orderBy('sellers.rating', 'DESC')
                                ->get();

            return view('search.visitorsearch.talents-search-result', compact('sellers', 'title'));

        }

        elseif ($request->search_type == 'courses') {

            $projects = Project::where('project_title', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('project_category', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('project_description', 'LIKE', '%'.$request->search_query.'%')
                                ->orWhere('project_category', 'LIKE', '%'.$request->search_query.'%')
                                ->orderBy('project_id', 'DESC')
                                ->get();

            return $projects;
        }

    }
}
