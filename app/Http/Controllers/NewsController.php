<?php

namespace App\Http\Controllers;

use App\User;
use App\News;
use App\tips;
use Auth;
use Goutte\Client;
use App\Http\Requests;
use Illuminate\Http\Request;

class TipsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Load user list
        $users = User::all();

        return view('news.index', ['users' => $users]);
    }

    public function site1()
    {
        $client = new Client();
        //$crawler = $client->request('GET', 'http://www.utusan.com.my/berita/jenayah');
        $crawler = $client->request('GET', 'https://www.cars.com/auto-repair/expert-tips/');
        for($a = 1; $a < $crawler->filter('section > dt > h3')->count(); $a++){
            echo "<h3>".$crawler->filter('section > dt > h3')->eq($a)->text() . "</h3><p>";
            $try = $crawler->filter('.cui-button')->eq($a)->attr('href');
            $this->detailinfo($try);
            
        }
    }

    public function detailinfo($try)
    {   
        $client = new Client();
       
        $crawler = $client->request('GET', "https://www.cars.com/".$try);
    
        for($a = 1; $a < ($crawler->filter('div > h4 > a')->count()-5) ; $a++){
               // $news->full_story .= $crawler->filter('p')->eq($a)->text() . " ";
                if($a%2 == 0)
                {
                echo $crawler->filter('div > h4 > a')->eq($a)->text() . "<p>";
                //echo "<i>".$crawler->filter('div > h4 > a')->eq($a)->attr('href') . "</i><p>";
                $detail = $crawler->filter('div > h4 > a')->eq($a)->attr('href');
                $this->detail2($detail);
                }

        }
    }

    public function detail2($detail)
    {   
        $client = new Client();
        
        $crawler = $client->request('GET', "https://www.cars.com/".$detail);
        if($crawler->filter('.body')->count())
        {
            echo $crawler->filter('.byline')->text()."<p>";
            echo "<img src ='".$crawler->filter('img')->attr('src')."'/><p>";
            echo $crawler->filter('.body')->text()."<p>";
        }   
    }

    public function harvest2()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.bharian.com.my/jenayah?m=1');//?page=3
        for($a = 1; $a < $crawler->filter('.row')->count() ; $a++){
            $news = new News;
            $data = new Data;
            $news->title = $crawler->filter('h2 > a')->eq($a)->text();
            $news->site_id = '1';
            $link = $crawler->filter('.row > a')->eq($a)->attr('data-node-url');
            $news->link = $link;
            $news->type = "Jenayah";
            $news->short_story = $crawler->filter('.lead')->eq($a)->text();
            $news->date = $crawler->filter('small')->eq($a)->text();
            $news->status = "New";
            $news->location = "";
            $news->lang = "my";
            $this->detail($link, $news);
            $data->news_id = $news->id;
            $data->url = $crawler->filter('.img-responsive')->eq($a)->attr('src');
            $data->type = "thumbnail";
            $data->save();
        };
        echo "Complete";
    }

    public function detail($link, $news)
    {   
        $client = new Client();
       
        $crawler = $client->request('GET', $link);

        if ($crawler->filter('p')->count()) {
            for($a = 1; $a < ($crawler->filter('p')->count()) ; $a++){
                $news->full_story .= $crawler->filter('p')->eq($a)->text() . " ";
            }
            
        }
            
        if ($crawler->filter('.author-left')->count()) {
            $news->author = $crawler->filter('.author-left')->text();
        }
        $news->save();
        if ($crawler->filter('.img-responsive')->count() > 3) {
            for($a = 1; $a < ($crawler->filter('.img-responsive')->count() - 2) ; $a++){
                $data = new Data;
                $data->news_id = $news->id;
                $data->type = "image";
                $data->url = $crawler->filter('.img-responsive')->eq($a)->attr('src');
                if ($crawler->filter('.gn4-inline-image-caption')->count()) {
                    $data->desc = $crawler->filter('.gn4-inline-image-caption')->eq($a-1)->text();
                }
                $data->save();
            }
        }
        
    }



}
