<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomLinkRequest;
use App\Models\Competition;
use App\Models\CustomLink;
use Illuminate\Support\Env;
use Illuminate\Support\Str;

class CustomLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($customUrl)
    {
        $customLink = CustomLink::where('link_url', Env::get('APP_URL') . '/uitnodiging/' . $customUrl)->first();

        if ($customLink) {
            return redirect(route('competition.show', $customLink->competition_id));
        }
        return back();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomLinkRequest $request, Competition $competition)
    {
        $request->validated();

        if (CustomLink::where('competition_id', $request->competition_id)->exists()) {
            flash()->error('Er is al eerder een eigen link aangemaakt.');
            return back();
        }

        $customLink = $request->input('custom_link');
        $pattern = '/^[a-zA-Z0-9\-_]+$/';

        if (!preg_match($pattern, $customLink)) {
            flash()->error('De link mag alleen letters, cijfers, - en _ bevatten.');
            return back();
        }

        $slug = Str::slug($customLink);

        if (CustomLink::where('link_url', $slug)->exists()) {
            flash()->error('Er is al een competitie die deze link gebruikt. Verzin een andere link.');
            return back();
        }

        $link = new CustomLink();
        $link['link_url'] = Env::get('APP_URL') . '/uitnodiging/' . $slug;
        $link['competition_id'] = $competition['id'];
        $link->save();

        flash('Je hebt succesvol een eigen link aangemaakt.');
        return redirect()->route('competition.show', $competition['id']);
    }
}
