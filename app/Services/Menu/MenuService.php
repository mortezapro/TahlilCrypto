<?php

namespace App\Services\Menu;

use App\Models\MenuModel;
use App\Repositories\Menu\MenuRepositoryInterface;
use Illuminate\Support\Facades\App;

class MenuService{

    public MenuRepositoryInterface $menuRepository;

    public function __construct()
    {
        $this->menuRepository = App::make(MenuRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->menuRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->menuRepository->paginate($paginate);
    }

    public function save(array $post,int $id = null)
    {
        return $this->menuRepository->save($post,$id);
    }

    public function update(array $post,string $slug)
    {
        return $this->menuRepository->save($post,$slug);
    }

    public function delete(MenuModel $menu)
    {
        return $menu->delete();
    }

}
