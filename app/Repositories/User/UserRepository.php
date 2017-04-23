<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Mail;
use DB;
use App\Models\Level;
use App\Models\Userlevel;
use App\Models\UserCategory;
use App\Models\Category;

class UserRepository extends BaseRepository
{
    function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($input, $sendMailData)
    {
        try {
            $createUser = $this->model->create($input);
            Mail::send('emails.active_account', $sendMailData, function ($message) use ($sendMailData) {
                $message->to($sendMailData['email'], $sendMailData['name'])->subject(trans('label.confirm_register'));
            });

            return $createUser;
        } catch (Exception $ex) {
            return $createUser['error'] = trans('message.creating_error');
        }
    }

    public function updateConfirm($confirmationCode)
    {
        $user = $this->model->confirmationCode($confirmationCode)->first();

        $user->confirmation_code ='';
        $user->confirmed = config('common.user.confirmed.is_confirm');
        $user->save();
        $levels = Level::lists('id');
        $user_levels = [];
        foreach ($levels as $id) {
            $user_levels[] = [
                'user_id' => $user->id,
                'level_id' => $id,
                'status' => 0,
            ];
        }

        $categories = Category::lists('id');
        $user_categories = [];
        foreach ($categories as $id) {
            $user_categories[] = [
                'user_id' => $user->id,
                'category_id' => $id,
                'status' => 0,
            ];
        }

        UserLevel::insert($user_levels);
        UserCategory::insert($user_categories);

        $level = Level::where('no', 1)->first();
        $user_level = UserLevel::where('level_id', $level->id)->update(['status' => 1]);
        $category_id = Category::where('level_id', $level->id)->lists('id');
        $user_category = UserCategory::whereIn('category_id', $category_id)->update(['status' => 1]);

        if (!$user) {
            throw new Exception(trans('message.item_not_exist'));
        }

        return $user;
    }
}
