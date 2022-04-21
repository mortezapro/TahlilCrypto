<?php

namespace App\Services\SearchHistory;

use App\Models\SearchHistoryModel;
use App\Repositories\SearchHistory\SearchHistoryRepositoryInterface;
use Illuminate\Support\Facades\App;

class SearchHistoryService{

    public SearchHistoryRepositoryInterface $searchHistoryRepository;

    public function __construct()
    {
        $this->searchHistoryRepository = App::make(SearchHistoryRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->searchHistoryRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->searchHistoryRepository->paginate($paginate);
    }

    public function save(array $post,int $id = null)
    {
        return $this->searchHistoryRepository->save($post,$id);
    }

    public function update(array $post,string $slug)
    {
        return $this->searchHistoryRepository->save($post,$slug);
    }

    public function delete(SearchHistoryModel $searchHistory)
    {
        return $searchHistory->delete();
    }

}
