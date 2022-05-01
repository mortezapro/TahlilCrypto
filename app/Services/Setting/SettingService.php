<?php

namespace App\Services\Setting;

use App\Models\SettingModel;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Support\Facades\App;

class SettingService{

    public SettingRepositoryInterface $settingRepository;

    public function __construct()
    {
        $this->settingRepository = App::make(SettingRepositoryInterface::class);
    }

    public function get(array $condition)
    {
        return $this->settingRepository->get($condition);
    }

    public function paginate(int $paginate)
    {
        return $this->settingRepository->paginate($paginate);
    }

    public function save(array $setting,int $id = null)
    {
        return $this->settingRepository->save($setting,$id);
    }

    public function update(array $setting,int $id)
    {
        return $this->settingRepository->save($setting,$id);
    }

    public function delete(SettingModel $setting)
    {
        return $setting->delete();
    }

}
