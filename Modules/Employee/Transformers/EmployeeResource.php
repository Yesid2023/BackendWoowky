<?php

namespace Modules\Employee\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'player_id' => $this->player_id,
            'user_type' => $this->user_type,
            'gender' => $this->gender,
            'expert' => $this->expert,
            'date_of_birth' => $this->date_of_birth,
            'email_verified_at' => $this->email_verified_at,
            'profile_image' => $this->profile_image,
            'status' => $this->status,
            'is_banned' => $this->is_banned,
            'is_manager' => $this->is_manager,
            'show_in_calender' => $this->show_in_calender,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'rating_star' => count($this->rating) > 0 ? (float) number_format(max($this->rating->avg('rating'), 0), 2) : 0,
            'about_self' => $this->profile->about_self ?? null,
            'facebook_link' => $this->profile->facebook_link ?? null,
            'instagram_link' => $this->profile->instagram_link ?? null,
            'twitter_link' => $this->profile->twitter_link ?? null,
            'dribbble_link' => $this->profile->dribbble_link ?? null,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'distance' => number_format($this->distance * 0.621371, 2)
        ];

        if ($this->user_type == 'boarder') {
            $response['location_images'] = $this->location_images;
            $response['location_prices'] = [
                'lodging_price' => $this->profile->lodging_price ?? null,
                'kindergarten_price' => $this->profile->kindergarten_price ?? null,
                'complete_care_price' => $this->profile->complete_care_price ?? null
            ];
        }

        return $response;
    }
}
