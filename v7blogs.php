<?php



 
 


 $url = "https://aatbs.com/blog/rss/";
 

  $feeds = simplexml_load_file($url);

 $i=0;
 if(!empty($feeds)){

  $site = $feeds->channel->title;
  $str = '<!Doctype html>
     <html>
      <head>
      
          <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
          <style>

          body{
            margin: 0;
            font-family: "Poppins",sans-serif;
            font-size: .9375rem;
            font-weight: 400;
            line-height: 1.5;
            color: #343a40;
            text-align: left;
        }
        .forumpost--blog img{ 
            height: 200px;    
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }
        .block-title{
            color:#455a64;
            font-size: 1.875rem;
            font-weight: normal;
        }
        .card-container{
            display:flex;
        }
        article{
            margin-bottom: 0.5rem;
            flex:0 0 50%;
            max-width: 50%;
        }
        .forumpost--blog{
            border:1px solid #dee2e6;
            padding: 1.5rem;
            
        }
        article:nth-child(odd) .forumpost--blog{
            margin-right: 10px;
        }
        .forumpost--blog h3{
            color:#455a64;
            margin-top:0;
            -webkit-line-clamp: 1;
        }
        .forumpost--blog h3{
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }
    
        .text-right{
            text-align: right;
        }
        p,ul{
            margin:0;
        }
        br{
            display: none;
        }
        a{
            color: #1177d1;
            text-decoration: none;
        }
        a:hover {
            color: #0b4f8a;
            text-decoration: underline;
        }
        .forumpost--blog .post-content-container{
            height:155px;
            overflow:auto;
        } 
        article:nth-child(odd) .forumpost--blog{
            border-bottom: 8px solid #FD0100;
        }
        article:nth-child(even) .forumpost--blog{
            border-bottom: 8px solid #02DDFD;
        }
        @media (max-width: 1199.98px) {
            .forumpost--blog img{
                width:100%;
            }
        }
        @media (max-width: 767px){
            .block-title {
                font-size: 1.234375rem;
            }
        }
        @media (max-width: 575.98px) { 
            .card-container{
                flex-direction: column;
            }
            article{
                flex:0 0 100%;
                max-width: 100%;
            }
            .forumpost--blog{
                margin-right: 0 !important;
            }
            
        }

       
  ​
          </style>
      </head>';
  $str .= '<div class="site-news-forum block-title-wrap">
  <h2 class="block-title">From our blogs</h2>
</div>
<div class="d-flex card-container">';
  

               
  foreach ($feeds->channel->item as $item) {
    if($i > 1) break;
    $title = $item->title;
 // $description = str_replace('width="1195" height="630"','',$item->description);
   $description = $item->description;
   $html = $description;
$doc = new DOMDocument();
@$doc->loadHTML($html);
$images = $doc->getElementsByTagName('img');
$images_src= $images[0]->getAttribute('src');
// echo $images_src;
 $description_des = preg_replace("/<img[^>]+\>/i", " ", $item->description);
  $description_remove_tags=preg_replace('#<p>(.*?)</p>#', '', $description_des);;
 // print_r($description_remove_tags);


   $link = $item->link;
   
                   $str .= '
                   <article class="forum-post-container mb-2 card-wrap card-wrap--blog">
                       <div class="d-flex border p-4 mb-2 card forumpost focus-target forumpost--blog">
                           <div class="d-flex flex-column w-100">
                           <div class="img-wrap mb-3">
                           <img src='. $images_src .' >
                       </div>
                               <div class="d-flex body-content-container">
                                   <div class="no-overflow w-100 content-alignment-container">
                                       <div class="post-content-container mb-3">
                                           
                                           <p>
                                           '.  implode(' ', array_slice(explode(' ', $description_des), 0, 35)) . ' ... '.'
                                           </p>
                                       </div>
                                       <div class="link text-right">
                                         
                                          <a target="_blank" href="'. $item->link .'">
                                              Learn More
                                          </a>
                                          
                                      </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </article>
                   ';
                   
                 
              

   
   
                   

   
   
   
   
    
    $i++;
   }

   $str .= '</div></html>';
   
   echo $str;
  
  file_put_contents('blogs_news.html',$str);
   
 }
 
 
 ?>

