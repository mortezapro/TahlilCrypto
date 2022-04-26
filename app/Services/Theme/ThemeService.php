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

    public function save(array $theme,int $id = null)
    {
        return $this->themeRepository->save($theme,$id);
    }

    public function update(array $theme,int $id)
    {
        return $this->themeRepository->save($theme,$id);
    }

    public function delete(ThemeModel $theme)
    {
        return $theme->delete();
    }

}
