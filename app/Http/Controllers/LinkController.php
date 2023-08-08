<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\StoreRequest;
use App\Models\Link;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $checkProtocol = explode(':', $data['full_link']);
        $checkExist = Link::where('full_link', $data['full_link'])->get();

        if ($checkProtocol[0] === 'http' || $checkProtocol[0] == 'https') {
            if ($checkExist->isEmpty()) {
                $shortLink = substr(md5(rand()), 0, 6);
                $shortLinkChecked = $this->checkUnique($shortLink);
                Link::firstOrCreate(['full_link' => $data['full_link']], ['short_link' => $shortLinkChecked]);
                $newLink = Link::where('full_link', $data['full_link'])->get();
                return view('home', compact('newLink'));
            } else {
                $existsLink = Link::where('full_link', $data['full_link'])->get();
                return view('home', compact('existsLink'));
            }
        } else {
            return view('home')->withErrors(['err' => 'Enter valid url with "http://" or "https://"']);
        }
    }

    public function redirection()
    {
        $url = url()->current();
        $shortLink = explode('http://127.0.0.1:8000/', $url);
        $checkLink = Link::where('short_link', $shortLink[1])->get();
        if ($checkLink->isEmpty()) {
            return 'link not found';
        } else {
            return Redirect::to($checkLink[0]->full_link);
        }
    }

    public function checkUnique($link)
    {
        $tst = Link::where('short_link', $link)->get();
        if ($tst->isEmpty()) {
            return $link;
        } else {
            $link = substr(md5(rand()), 0, 6);
            return $this->checkUnique($link);
        }
    }
}
