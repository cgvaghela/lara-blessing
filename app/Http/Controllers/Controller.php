<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public static function getSettings() {
        $setting = \App\Setting::first();
        if ($setting) {
            \Config::set('settings.title', $setting->site_title);
            \Config::set('settings.logo', $setting->logo);
            \Config::set('settings.email', $setting->email);
            \Config::set('settings.phone', $setting->phone);
            \Config::set('settings.map', $setting->map);
            \Config::set('settings.address', $setting->address);
            \Config::set('settings.facebook', $setting->facebook);
            \Config::set('settings.twitter', $setting->twitter);
            \Config::set('settings.linkedin', $setting->linkedin);
            \Config::set('settings.googleplus', $setting->googleplus);
            
        }
        return $setting;
    }
    
    public static function getAdminSettings() {
        $admin = \App\Admin::first();
        $appName = \Config::get('app.name');
        if ($admin) {
            \Config::set('mail.from.address', $admin->email);
            \Config::set('mail.from.name', $appName);
            
            \Config::set('settings.admin.email', $admin->email);
            \Config::set('settings.admin.name', $admin->firstname.' '.$admin->lastname);
        }
        return $admin;
    }
    
    public static function getMetadata(){
        $url = \Request::url();
        $segment1 = \Request::segment(1);
        $segment2 = \Request::segment(2);

        $metadata = \App\Metadata::where('url', $url)->first();

        if ($metadata) {
            \Config::set('settings.title', $metadata->title);
            \Config::set('settings.metaTitle', $metadata->meta_title);
            \Config::set('settings.metaKeywords', $metadata->meta_keywords);
            \Config::set('settings.metaDescription', $metadata->meta_description);
        }

        if ($segment1 && $segment2 == "") {
            $metadata = \App\Metadata::where('url', $segment1)->first();
            if (isset($metadata)) {
                \Config::set('settings.title', $metadata->title);
                \Config::set('settings.metaTitle', $metadata->meta_title);
                \Config::set('settings.metaKeywords', $metadata->meta_keywords);
                \Config::set('settings.metaDescription', $metadata->meta_description);
            } else {
                \Config::set('settings.title', config('settings.title'));
                \Config::set('settings.metaTitle', config('settings.metaTitle'));
                \Config::set('settings.metaKeywords', config('settings.metaKeywords'));
                \Config::set('settings.metaDescription', config('settings.metaDescription'));
            }
        }
        
        if ($segment2) {
            $metadata = \App\Metadata::where('url', $segment1 . '/' . $segment2)->first();
            if (isset($metadata)) {
                \Config::set('settings.title', $metadata->title);
                \Config::set('settings.metaTitle', $metadata->meta_title);
                \Config::set('settings.metaKeywords', $metadata->meta_keywords);
                \Config::set('settings.metaDescription', $metadata->meta_description);
            } else {
                \Config::set('settings.title', config('settings.title'));
                \Config::set('settings.metaTitle', config('settings.metaTitle'));
                \Config::set('settings.metaKeywords', config('settings.metaKeywords'));
                \Config::set('settings.metaDescription', config('settings.metaDescription'));
            }
        }
        return $url;
    }
}
Controller::getSettings();
Controller::getAdminSettings();
Controller::getMetadata();