<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Secretary;
use App\Models\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class WebController extends Controller
{
    /**
     * Mostrar a página inicial do site
     * 
     * @route /  GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secretaries = Secretary::all(['name', 'theme', 'theme_slug', 'icon']);

        SEOMeta::addMeta('Content-Type', 'text/html; charset=utf-8');
        SEOMeta::addMeta('viewport', 'width=device-width, initial-scale=1');
        SEOMeta::setTitle('Home - Carta de Serviços - Prefeitura Municipal de São Bento');
        SEOMeta::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        
        OpenGraph::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        OpenGraph::setTitle('Home - Carta de Serviços - Prefeitura Municipal de São Bento');
        OpenGraph::setUrl(route('web.home'));
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(asset('images/web/prefeitura_sede.jpg'));

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('Home - Carta de Serviços - Prefeitura Municipal de São Bento');
        TwitterCard::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        TwitterCard::setUrl(route('web.home')); 
        TwitterCard::setImage(asset('images/web/prefeitura_sede.jpg'));

        return view('web.home.index', [
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Mostrar a página de perguntas frequentes no site
     * 
     * @route /  GET
     * @return \Illuminate\Http\Response
     */
    public function faq()
    {
        $faq = Faq::getFaq();
    
        SEOMeta::addMeta('Content-Type', 'text/html; charset=utf-8');
        SEOMeta::addMeta('viewport', 'width=device-width, initial-scale=1');
        SEOMeta::setTitle('Perguntas frequentes - Carta de Serviços - Prefeitura Municipal de São Bento');
        SEOMeta::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        
        OpenGraph::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        OpenGraph::setTitle('Perguntas frequentes - Carta de Serviços - Prefeitura Municipal de São Bento');
        OpenGraph::setUrl(route('web.home'));
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(asset('images/web/prefeitura_sede.jpg'));

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle('Perguntas frequentes - Carta de Serviços - Prefeitura Municipal de São Bento');
        TwitterCard::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        TwitterCard::setUrl(route('web.home')); 
        TwitterCard::setImage(asset('images/web/prefeitura_sede.jpg'));

        return view('web.faq.index', [
            'faq' => $faq
        ]);
    }

    public function secretary($secretarySlug)
    {
        $secretary = Secretary::where('theme_slug', $secretarySlug)->firstOrFail();
        $services = Service::with('secretary')->where('secretary_id', $secretary->id)->get();

        SEOMeta::addMeta('Content-Type', 'text/html; charset=utf-8');
        SEOMeta::addMeta('viewport', 'width=device-width, initial-scale=1');
        SEOMeta::setTitle("{$secretary->name} - Carta de Serviços - Prefeitura Municipal de São Bento");
        SEOMeta::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        
        OpenGraph::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        OpenGraph::setTitle("{$secretary->name} - Carta de Serviços - Prefeitura Municipal de São Bento");
        OpenGraph::setUrl(route('web.home'));
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(asset('images/web/prefeitura_sede.jpg'));

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle("{$secretary->name} - Carta de Serviços - Prefeitura Municipal de São Bento");
        TwitterCard::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        TwitterCard::setUrl(route('web.home')); 
        TwitterCard::setImage(asset('images/web/prefeitura_sede.jpg'));

        return view('web.secretary.index', [
            'secretary' => $secretary,
            'services' => $services
        ]);
    }

    public function secretaryServices($secretarySlug, $serviceSlug)
    {
        $secretary = Secretary::where('theme_slug', $secretarySlug)->firstOrFail();
        $service = Service::where('name_slug', $serviceSlug)->firstOrFail();

        SEOMeta::addMeta('Content-Type', 'text/html; charset=utf-8');
        SEOMeta::addMeta('viewport', 'width=device-width, initial-scale=1');
        SEOMeta::setTitle("{$service->name} - Carta de Serviços - Prefeitura Municipal de São Bento");
        SEOMeta::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        
        OpenGraph::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        OpenGraph::setTitle("{$service->name} - Carta de Serviços - Prefeitura Municipal de São Bento");
        OpenGraph::setUrl(route('web.home'));
        OpenGraph::addProperty('type', 'articles');
        OpenGraph::addImage(asset('images/web/prefeitura_sede.jpg'));

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle("{$service->name} - Carta de Serviços - Prefeitura Municipal de São Bento");
        TwitterCard::setDescription('A Prefeitura Municipal de São Bento, objetivando maior visibilidade e transparência às suas ações, apresenta sua Carta de Serviços com informações claras e precisas sobre os principais serviços prestados aos cidadãos.');
        TwitterCard::setUrl(route('web.home')); 
        TwitterCard::setImage(asset('images/web/prefeitura_sede.jpg'));

        return view('web.service.index', [
            'secretary' => $secretary,
            'service' => $service
        ]);
    }
}
