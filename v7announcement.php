<?php

require('config.php');

$sql = 'SELECT DATE_FORMAT(FROM_UNIXTIME(created),"%M %d, %Y") AS "created",subject,message from mdl_forum_posts ORDER BY id DESC LIMIT 3';
//$sql = 'SELECT 1 AS "created",subject,message from mdl_forum_posts ORDER BY id DESC LIMIT 3';
$query_result = $DB->get_recordset_sql($sql);
//echo "<pre>";
//print_r($query_result);
//echo "</pre>";
//exit;

$str = '<!Doctype html>
<html>
 <head>
 <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,300;1,400&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
 <style>
     body {
        margin: 0;
        font-family: "Poppins",sans-serif;
        font-size: .9375rem;
        font-weight: 400;
        line-height: 1.5;
        color: #343a40;
        text-align: left;
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
            flex:0 0 33.33%;
            max-width: 33.33%;
        }
        .forumpost--announcement{
            border:1px solid #dee2e6;
            padding: 1.5rem;
            
        }
        .forumpost--announcement address{
            font-style: normal;
            margin-bottom: 0.5rem;
        }
        article:not(:last-child) .forumpost--announcement{
            margin-right: 10px;
        }
        .forumpost--announcement h3{
            color:#455a64;
            margin-top:0;
            font-size: .9375rem;
            -webkit-line-clamp: 1;
        }
        .forumpost--announcement p:nth-child(2),.forumpost--announcement h3{
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }
     
        .forumpost--announcement p:nth-child(2){
            -webkit-line-clamp: 4;
            height: 90px;
        }
        .text-right{
            text-align: right;
        }
        .forumpost--announcement .post-content-container, .forumpost--announcement address{
            color:#919398;
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
            .forumpost--announcement{
                margin-right: 0 !important;
            }
         }
    
​
     </style>
 </head>';

$str .= '<div class="site-news-forum block-title-wrap">
  <h2 class="block-title">Announcements</h2>
</div>
<div class="d-flex card-container">';

    $i=0;
foreach($query_result as $record){
  //  echo $i .'<br>';
   // if($i > 2) break;
     $subject =$record->subject ;
     $created = $record->created;
     $message =$record->message ;
     
    
    $str .='
    <article class="forum-post-container mb-2 card-wrap" data-post-id="25" data-region="post" data-target="25-target" tabindex="0" aria-labelledby="post-header-25-5f2bb94f50a295f2bb94f318e814" aria-describedby="post-content-25">
                       <div class="d-flex border p-4 mb-2 forumpost focus-target forumpost--announcement card" aria-label="Subject (hidden) by Author (hidden)" data-post-id="25" data-content="forum-post">
                           <div class="d-flex flex-column w-100" data-region-content="forum-post-core">
                               <header id="post-header-25-5f2bb94f50a295f2bb94f318e814" class="mb-3 header d-flex flex-column">
                                   <address tabindex="-1">
                                           <time>
                                              ' . $record->created .'
                                           </time>
                                   </address>
                                   <h3 class="h6 mb-0 card-title" data-region-content="forum-post-core-subject" data-reply-subject="Re: Subject (hidden)">' . $subject =$record->subject .'</h3>
                               </header>
                               <div class="d-flex body-content-container">
                                   <div class="no-overflow w-100 content-alignment-container">
                                       <div id="post-content-25" class="post-content-container mb-3">
                                           <p>
                                           ' . $record->message .'
                                           </p>                               
                                           </div>
                                           <div class="link text-right">
                                          <a href="#" aria-label="Discuss the topic: Subject (hidden)">
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

file_put_contents('v7_announcement.html',$str);



?>