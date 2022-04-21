<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\SearchHistoryModel;
use App\Services\SearchHistory\SearchHistoryService;
use Illuminate\Support\Facades\App;
use App\Http\Requests\SearchHistoryRequest;

class SearchHistoryController extends Controller
{

    public searchHistoryService $searchHistoryService;

    public function __construct()
    {
        $this->searchHistoryService = App::make(SearchHistoryService::class);
    }

    public function index()
    {
        $searchHistories = $this->searchHistoryService->paginate(10);
        return view("panel.searchHistories.index",compact("searchHistories"));
    }

    public function create()
    {
        return view("panel.searchHistories.new");
    }

    public function edit(SearchHistoryModel $searchHistory)
    {
        return view("panel.searchHistories.edit",compact("searchHistory"));
    }

    public function store(SearchHistoryRequest $request, SearchHistoryModel $searchHistory = null)
    {
        $searchHistoryData = $request->all();

        $searchHistory ? $this->searchHistoryService->save($searchHistoryData,$searchHistory->id) : $searchHistory = $this->searchHistoryService->save($searchHistoryData);

        // there is a situation that searchHistory has not changed, but gallery request changed. this situation SearchHistoryObserver has not performed updated method.
        // so, we should check gallery request in the controller.
        // if request has any gallery then upload it and save to db and sync galleriables
        // and also category request

        if($searchHistory){
            return redirect()->route('admin.searchHistories.index')->with('save',true);
        }
        return abort(500);
    }

    public function destroy(SearchHistoryModel $searchHistory)
    {
        if( $this->searchHistoryService->delete($searchHistory) ){
            return redirect()->route("admin.searchHistories.index")->with("delete",true);
        }
    }

}
