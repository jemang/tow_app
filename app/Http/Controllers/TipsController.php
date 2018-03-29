<?php

namespace App\Http\Controllers;

use App\User;
use App\News;
use App\tips;
use Auth;
use DB;
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


    public function mainTips()
    {
        $shop = tips::select(DB::Raw('category, COUNT(*) as count'))->groupBy('category')->get();
        return view('auth/main_tip', ['shop' => $shop]);
    }

    public function viewTips($gp)
    {
        if($gp != null)
        {
            //paginate(20)
            $shop = tips::where('category', '=' ,$gp)->get();
            if($shop)
            {
 
                return view('auth/v_tips', ['shop' => $shop]);
            }
            else
            {
                return redirect('/mtip')->withErrors(['msg'=>'Data Not Found!!']);
            } 
        }
    }

    public function test()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.cars.com/auto-repair/expert-tips/');
        for($a = 1; $a < $crawler->filter('section > dt > h3')->count(); $a++)
        {
            echo "<h3>".$crawler->filter('section > dt > h3')->eq($a)->text()."</h3><p>";
            $try = $crawler->filter('.cui-button')->eq($a)->attr('href');
            $crawler1 = $client->request('GET', "https://www.cars.com/".$try);
            $page = 0;
            while($page < 2)
            {
                if($page > 0)
                    $crawler1 = $client->request('GET', "https://www.cars.com/".$try.'/?pageIndex='.$page);
                for($b = 1; $b < ($crawler1->filter('div > h4 > a')->count()) ; $b++)
                {
                    if($b%2 == 0)
                    {
                        echo "<p>".$crawler1->filter('div > h4 > a')->eq($b)->text()."</p>";
                        $detail = $crawler1->filter('div > h4 > a')->eq($b)->attr('href');
                        $crawler2 = $client->request('GET', "https://www.cars.com/".$detail);
                        if($crawler2->filter('.body')->count())
                        {
                            echo $crawler2->filter('header > h1')->text()."</p>";
                            echo $crawler2->filter('.author')->text()."</p>";
                            echo $crawler2->filter('.date')->text()."</p>";
                            echo $crawler2->filter('img')->attr('src')."</p>";
                            echo $crawler2->filter('.body')->html()."</p>";
                        }   
                    }
                }
                $page++;
            }
        }   
    }

    public function site1()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.cars.com/auto-repair/expert-tips/');
        for($a = 1; $a < $crawler->filter('section > dt > h3')->count(); $a++)
        {
            $group = $crawler->filter('section > dt > h3')->eq($a)->text();
            $try = $crawler->filter('.cui-button')->eq($a)->attr('href');
            $crawler1 = $client->request('GET', "https://www.cars.com/".$try);
            $page = 0;
            while($page < 2)
            {
                if($page > 0)
                    $crawler1 = $client->request('GET', "https://www.cars.com/".$try.'/?pageIndex='.$page);
                for($b = 1; $b < ($crawler1->filter('div > h4 > a')->count()) ; $b++)
                {
                    if($b%2 == 0)
                    {
                        $tips = new tips;
                        //echo "<p>".$crawler1->filter('div > h4 > a')->eq($b)->text()."</p>";
                        $detail = trim($crawler1->filter('div > h4 > a')->eq($b)->attr('href'));
                        $name = trim($crawler1->filter('div > h4 > a')->eq($b)->text());
                        $tips-> link = $detail;
                        $tips-> title = $name;
                        //echo tips::where('link','LIKE', '%'. $detail .'%')->count();
                        //echo tips::where('link','LIKE', '%'. $detail .'%')->count()."<br>";
                        if(tips::where('link','LIKE', '%'. $detail .'%')-> count() > 0 || tips::where('title','LIKE', '%'. $name .'%')-> count() > 0)
                        {
                            continue;
                        }
                        else
                        {
                            $crawler2 = $client->request('GET', "https://www.cars.com/".$detail);
                            if($crawler2->filter('.body')->count())
                            {
                                //$tips-> title = $crawler2->filter('header > h1')->text();
                                $tips-> category = $group;
                                $tips-> author = $crawler2->filter('.author')->text();
                                $tips-> date = $crawler2->filter('.date')->text();
                                $tips-> picture = $crawler2->filter('img')->attr('src');
                                $tips-> info = $crawler2->filter('.body')->html();
                                $tips-> source = "www.cars.com";
                                $tips-> save();
                            }   
                        }
                    }
                }
                $page++;
            }
        }  
        return redirect('/mtip')->withErrors(['msg'=>'Done Update!!']);        
    }

    
   /**public function site2()
    {
        $client = new Client();
        //$crawler = $client->request('GET', 'http://www.utusan.com.my/berita/jenayah');
        $crawler = $client->request('GET', 'https://www.cars.com/auto-repair/expert-tips/');
        for($a = 1; $a < $crawler->filter('section > dt > h3')->count(); $a++){
            $crawler->filter('section > dt > h3')->eq($a)->text() . "</h3>";
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
                $tips = new tips;
                $tips->title = $crawler->filter('div > h4 > a')->eq($a)->text();
                if(!tips::where('title',$tips->title)->first())
                {
                    $detail = $crawler->filter('div > h4 > a')->eq($a)->attr('href');
                    $this->saveTips($detail);
                }
            }

        }
    }


    public function saveTips($detail)
    {   
        $client = new Client();
        
        $crawler = $client->request('GET', "https://www.cars.com/".$detail);
        if($crawler->filter('.body')->count())
        {
            $tips = new tips;
            $tips-> title = $crawler->filter('header > h1')->text();
            $tips-> author = $crawler->filter('.author')->text();
            $tips-> date = $crawler->filter('.date')->text();
            $tips-> picture = $crawler->filter('img')->attr('src');
            $tips-> info = $crawler->filter('.body')->text();
            $tips-> save();
        }   
    }
**/


    public function openTips($id) 
    {
        $s1 = "www.cars.com";
        if($id != null) 
        {
            $shop = tips::where('tip_id', '=' ,$id)->first();
            if($shop && $shop-> source == $s1)
            {
 
                return view('auth/v_TipsDetail', ['shop' => $shop]);
            }
            else
            {
                return view('auth/v_TipsDetail2', ['shop' => $shop]);
            }   
        } 
        else 
        {
            return redirect('/mtip')->withErrors(['msg'=>'Data Not Found!!']);
        }
    }

    public function deltips($id) 
    {
        if($id != null) 
        {        
            $shop = tips::where('tip_id', '=' ,$id)->first();
            $gb = $shop->category;
            tips::where('tip_id', '=' ,$id)->delete();
            return redirect('/tip/'.$gb)->withErrors(['msg'=>'Tips deleted']);
        } 
        else 
        {
            return redirect('/admin_view');
        }
    }


    public function test2()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://car.tips.net/');
        for($a = 0; $a < $crawler->filter('div > h4 > a')->count(); $a++)
        {
            echo "<h3>".$crawler->filter('div > h4 > a')->eq($a)->text()."</h3><p>";
            $try = $crawler->filter('div > h4 > a')->eq($a)->attr('href');
            $crawler1 = $client->request('GET', $try);

                /**if($crawler1->filter('.col > h4 > a')->count())
                    {
                        for($c = 0; $c < $crawler1->filter('.col > h4 > a')->count(); $c++)
                        {
                            echo $crawler1->filter('.col > h4 > a')->eq($c)->attr('href')."<p>";
                        }
                    } **/
                
                for($b = 0; $b < $crawler1->filter('.article > a')->count(); $b++)
                {
                    echo "<p>".$crawler1->filter('.article > a')->eq($b)->text()."</p>";
                    $detail = $crawler1->filter('.article > a')->eq($b)->attr('href');
                    $crawler2 = $client->request('GET', $detail);
                    if($crawler2->filter('.byline')->count())
                    {
                        echo $crawler2->filter('.byline > i')->text()."</p>";
                        echo $crawler2->filter('.byline')->text()."</p>";
                    }

                    if($crawler2->filter('#usernotes')->count())
                    {
                        $del = $crawler2->filter('#usernotes')->html();
                    }

                    if($crawler2->filter('.intro')->count())
                    {
                        $info = $crawler2->filter('.intro')->html();
                        echo str_replace($del, ' ', $info);
                    }
               } 
        }   
    }

    public function site2()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://car.tips.net/');
        for($a = 0; $a < $crawler->filter('div > h4 > a')->count(); $a++)
        {
            $group = $crawler->filter('div > h4 > a')->eq($a)->text();
            $try = $crawler->filter('div > h4 > a')->eq($a)->attr('href');
            $crawler1 = $client->request('GET', $try);

                for($b = 0; $b < $crawler1->filter('.article > a')->count(); $b++)
                {
                    $tips = new tips;
                    $name = trim($crawler1->filter('.article > a')->eq($b)->text());
                    $detail = trim($crawler1->filter('.article > a')->eq($b)->attr('href'));
                    $crawler2 = $client->request('GET', $detail);
                    $tips-> link = $detail;
                    $tips-> title = $name;

                    if(tips::where('link','LIKE', '%'. $detail .'%')-> count() > 0 || tips::where('title','LIKE', '%'. $name .'%')-> count() > 0)
                    {
                            continue;
                    }
                    else
                    {
                        if($crawler2->filter('.byline')->count())
                        {
                            $tips-> author = $crawler2->filter('.byline > i')->text();
                            $tips-> date = $crawler2->filter('.byline')->text();
                        }

                        if($crawler2->filter('#usernotes')->count())
                        {
                            $del = $crawler2->filter('#usernotes')->html();
                        }

                        if($crawler2->filter('.intro')->count())
                        {
                            $info = $crawler2->filter('.intro')->html();
                            $tips-> info = str_replace($del, ' ', $info);
                            $tips-> category = $group;
                            $tips-> source = "http://car.tips.net";
                        }
                        $tips-> save();
                    }
                } 
        } 
        return redirect('/mtip')->withErrors(['msg'=>'Done Update!!']);   
    }

}
