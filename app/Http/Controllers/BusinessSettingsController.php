<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use Artisan;

class BusinessSettingsController extends Controller
{
    public function general_setting(Request $request)
    {
        return view('backend.setup_configurations.general_settings');
    }

    public function smtp_settings(Request $request)
    {
        return view('backend.setup_configurations.smtp_settings');
    }

    /**
     * Update the API key's for other methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

    /**
     * overWrite the Env File values.
     * @param  String type
     * @param  String value
     * @return \Illuminate\Http\Response
     */
    public function overWriteEnvFile($type, $val)
    {
        if (env('DEMO_MODE') != 'On') {
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"' . trim($val) . '"';
                if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, str_replace(
                        $type . '="' . env($type) . '"',
                        $type . '=' . $val,
                        file_get_contents($path)
                    ));
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
                }
            }
        }
    }

    public function update(Request $request)
    {

        foreach ($request->types as $key => $type) {
            if ($type == 'site_name') {
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            if ($type == 'timezone') {
                $this->overWriteEnvFile('APP_TIMEZONE', $request[$type]);
            } else {
                $lang = null;
                if (gettype($type) == 'array') {
                    $lang = array_key_first($type);
                    $type = $type[$lang];
                    $business_settings = BusinessSetting::where('type', $type)->where('lang', $lang)->first();
                } else {
                    $business_settings = BusinessSetting::where('type', $type)->first();
                }

                if ($business_settings != null) {
                    if (gettype($request[$type]) == 'array') {
                        $business_settings->value = json_encode($request[$type]);
                    } else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->lang = $lang;
                    $business_settings->save();
                } else {
                    $business_settings = new BusinessSetting;
                    $business_settings->type = $type;
                    if (gettype($request[$type]) == 'array') {
                        $business_settings->value = json_encode($request[$type]);
                    } else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->lang = $lang;
                    $business_settings->save();
                }
            }
        }

        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }

}
