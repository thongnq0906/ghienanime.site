<?php
    namespace App\Http\Composers;

    use Illuminate\Contracts\View\View;
    use App\Models\Setting;
    use App\Models\Slide;

    class SettingComposer
    {
        public function compose(View $view)
        {
            $setting = Setting::first();
            $slides = Slide::where('status', 1)->where('dislay', 1)->orderBy('position', 'ASC')->get();

            $data = [
                'setting' => $setting,
                'slides' => $slides,
            ];

            $view->with($data);
        }
    }
