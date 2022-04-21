<?php

namespace App\Services\Theme;

use App\Models\ThemeModel;
use App\Repositories\Theme\ThemeRepositoryInterface;
use Illuminate\Support\Facades\App;

class ThemeService{

    public ThemeRepositoryInterface $themeRepository;

    public function __construct()
    {
        $this->themeRepository = App::make(ThemeRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->themeRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->themeRepository->paginate($paginate);
    }

    public function save(array $post,int $id = null)
    {
        return $this->themeRepository->save($post,$id);
    }

    public function update(array $post,string $slug)
    {
        return $this->themeRepository->save($post,$slug);
    }

    public function delete(ThemeModel $theme)
    {
        return $theme->delete();
    }

}
