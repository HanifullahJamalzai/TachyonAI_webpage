<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Str;
use Session;

use App\Models\Hero;
use App\Models\Client;
use App\Models\About;
use App\Models\WhyUs;
use App\Models\WhyUsAccordion;
use App\Models\Skill;
use App\Models\SkillProgress;
use App\Models\Service;
use App\Models\ServiceBox;
use App\Models\CTA;
use App\Models\Portfolio;
use App\Models\PortfolioDetail;
use App\Models\Team;
use App\Models\TeamDetail;
use App\Models\Pricing;
use App\Models\PricingDetail;
use App\Models\Faq;
use App\Models\FaqAccordion;
use App\Models\Contact;
use App\Models\Inbox;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cat = PortfolioDetail::select('type')->distinct()->get();
        return view('welcome', compact('cat'))
                    ->with('hero', Hero::findOrFail(1))
                    ->with('clients', Client::all())
                    ->with('about', About::findOrFail(1))
                    ->with('why', WhyUs::findOrFail(1))
                    ->with('whyusaccordion', WhyUsAccordion::all())
                    ->with('skill', Skill::findOrFail(1))
                    ->with('skills', SkillProgress::all())
                    ->with('service', Service::findOrFail(1))
                    ->with('serviceboxes', ServiceBox::all())
                    ->with('cta', CTA::findOrFail(1))
                    ->with('portfolio', Portfolio::findOrFail(1))
                    ->with('portfolios', PortfolioDetail::all())
                    ->with('team', Team::findOrFail(1))
                    ->with('members', TeamDetail::all())
                    ->with('pricing', Pricing::findOrFail(1))
                    ->with('plans', PricingDetail::orderBy('id','desc')->get())
                    ->with('faq', Faq::findOrFail(1))
                    ->with('faqs', FaqAccordion::orderBy('id', 'asc')->get())
                    ->with('contact', Contact::findOrFail(1))
                    ->with('Page', 'TachyonAI');

    }


    public function message(request $request)
    {
        $request->validate([
            'name'=>'required|max:255|min:3',
            'email'=>'required|max:255|min:10',
            'subject'=>'required|max:255|min:4',
            'message'=>'required|min:5'
        ]);
        $request->merge(['slug' => Str::slug($request->email.' '.Str::random())]);

        $input = $request->all();
        Inbox::create($input);

        Session::flash('success', 'Hi! We wanted to let you know that we have received your message.We’ll get back to you as soon as we can.');
        return redirect()->back();

    }
}
