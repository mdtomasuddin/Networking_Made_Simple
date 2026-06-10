<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{

        protected $guarded = [];

        protected $casts = [
                'sub_image'       => 'array',
                'image'           => 'string',
                'title'           => 'string',
                'page'            => 'string',
                'section'         => 'string',
                'description'     => 'string',
                'sub_title'       => 'string',
                'sub_description' => 'string',
                'button'          => 'string',
                'sub_button'      => 'string',
                'status'          => 'string',
        ];

        // //live link
        public function getImageAttribute($value): string | null
        {
                if (filter_var($value, FILTER_VALIDATE_URL)) {
                        return $value;
                }
                // Check if the request is an API request
                if (request()->is('api/*') && ! empty($value)) {
                        // Return the full URL for API requests
                        return url($value);
                }
                // Return only the path for web requests
                return $value;
        }

        // public function getSubImageUrlsAttribute(): array
        // {
        //         $images = $this->sub_image ?? [];

        //         if (! is_array($images)) {
        //                 return [];
        //         }

        //         return array_map(function ($image) {
        //                 if (filter_var($image, FILTER_VALIDATE_URL)) {
        //                         return $image;
        //                 }

        //                 return url($image);
        //         }, $images);
        // }

        // Accessor for the single 'image' field
        // public function getImageAttribute($value): ?string
        // {
        //         if (empty($value)) {
        //                 return null;
        //         }
        //         return filter_var($value, FILTER_VALIDATE_URL) ? $value : url($value);
        // }


        // Accessor for the 'sub_image' array
        // Transforming the existing field directly is often cleaner
        public function getSubImageAttribute($value): array
        {
                $images = json_decode($value, true) ?? [];

                return array_map(function ($image) {
                        if (empty($image) || filter_var($image, FILTER_VALIDATE_URL)) {
                                return $image;
                        }
                        return url($image);
                }, $images);
        }
}
