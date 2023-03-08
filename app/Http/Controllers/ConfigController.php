<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Carousel;
use App\Models\Contact;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ConfigController extends Controller
{
    // pages app
    public function app()
    {
        $app = App::find(1);
        $carousel = Carousel::all();
        return view('admin.config.app', compact('app', 'carousel'));
    }

    public function app_update(Request $request)
    {
        $app = App::find(1);
        $data = $request->all();

        $app = $app->update($data);
        return redirect('/admin/config')->with('success', 'App has ben updated!');
    }

    // Hero edit
    public function hero_edit($id)
    {
        $hero = Carousel::query()->whereId($id)->first();
        return view('admin.config.hero.edit', compact('hero'));
    }

    public function hero_update(Request $request, $id)
    {
        $hero = Carousel::whereId($id)->first();
        $data = $request->all();
        $hero = $hero->update($data);
        return redirect('/admin/config')->with('success', 'Hero Section ' . $request->title . ' has ben updated!');
    }

    // pages social media
    public function social_media()
    {
        $socialMedia = SocialMedia::find(1);
        return view('admin.config.social_media', compact('socialMedia'));
    }

    public function social_media_update(Request $request)
    {
        $socialMedia = SocialMedia::find(1);
        $data = $request->all();

        $socialMedia = $socialMedia->update($data);
        return redirect('/admin/config')->with('success', 'Social Media has ben updated!');
    }

    // Pages contact
    public function contact()
    {
        $contact = Contact::find(1);
        return view('admin.config.contact', compact('contact'));
    }

    public function contact_update(Request $request)
    {
        $contact = Contact::find(1);
        $data = $request->all();
        $contact = $contact->update($data);
        return redirect('/admin/config')->with('success', 'Contact has ben updated!');
    }
}
