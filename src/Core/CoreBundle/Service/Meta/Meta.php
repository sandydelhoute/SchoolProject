<?php

namespace Core\CoreBundle\Service\Meta;

use Symfony\Component\HttpFoundation\Response;

class Meta
{
  public function metaDonnees(Response $response,Array $arrayMeta)
  {
    $content = $response->getContent();
    $metaTitle="<title>".$arrayMeta['title']."</title>";
    $metaDescription="<meta name='description' content='".$arrayMeta['description']."' />";

    $meta=$metaTitle;
   	$meta.=$metaDescription;
   	if(isset($arrayMeta['openGraph']))
    {
    	$meta.=$this->openGraph($arrayMeta['openGraph']);
    }
    if(isset($arrayMeta['twitter']))
    {
    	$meta.=$this->twitter($arrayMeta['twitter']);
    }
   	if(isset($arrayMeta['googlePlus']))
    {
    	$meta.=$this->googlePlus($arrayMeta['googlePlus']);
    }
   	
    // Insertion du code dans la page, dans le premier <h1>
    $content = str_replace(
      '<title>Welcome!</title>',
      $meta,
      $content
    );
    // Modification du contenu dans la réponse
    $response->setContent($content);

    return $response;
  }

  private function openGraph($arrayOpengraph){
  	
  	$openGraph="";
  	if(isset($arrayOpengraph['title']))
  	{
	  	$openGraphTitle="<meta property='og:title' content='".$arrayOpengraph['title']."' />";
	  	$openGraph .= $openGraphTitle;
  	}
  	if(isset($arrayOpengraph['type']))
  	{
	   	$openGraphType="<meta property='og:type' content='".$arrayOpengraph['type']."' />";
	   	$openGraph.=$openGraphType;
  	}
   	if(isset($arrayOpengraph['url']))
  	{
	   	$openGraphUrl="<meta property='og:url' content='".$arrayOpengraph['url']."' />";
	   	$openGraph.=$openGraphUrl;
  	}

   	if(isset($arrayOpengraph['image']))
  	{
		$openGraphImage="<meta property='og:image' content='".$arrayOpengraph['image']."' />";
		$openGraph.=$openGraphImage;
  	}
   	
   	return $openGraph ;
  }

  private function twitter($arrayTwitter){
	$twitterImage ="<meta name='twitter:card' content='summary_large_image'>";
	$twitterSite ="<meta name='twitter:site' content='@skyminds'>";
	$twitterTitle ="<meta name='twitter:title' content='Page Title'>";
	$twitterdescription ="<meta name='twitter:description' content='Page description : less than 200 characters'>";
	$twitterCreator ="<meta name='twitter:creator' content='@skyminds'>";
	$twitterUrl ="<meta name='twitter:url' content='Page URL' />";
	$twitterDomain ="<meta name='twitter:domain' content='domain URL' />";
	$twitter = $twitterImage;
	$twitter.=$twitterSite;
	$twitter.=$twitterTitle;
	$twitter.=$twitterdescription;
	return $twitter;
  }

  private function googlePlus($arrayGooglePlus){

  	$google="";
  	if(isset($arrayGooglePlus['title']))
  	{	
	$googleName ="<meta itemprop='name' content='".$arrayGooglePlus['title']."'>";
	$google .= $googleName;
	}

	if(isset($arrayGooglePlus['description']))	
	{
		$googleDescription ="<meta itemprop='description' content='".$arrayGooglePlus['description']."'>";
		$google .= $googleDescription ;

	}
	if(isset($arrayGooglePlus['image']))
	{
		$googleImage ="<meta itemprop='image' content='".$arrayGooglePlus['image']."'>";
		$google .= $googleImage;

	}

	if(isset($arrayGooglePlus['author']))
	{
		$googleAuthor ="<link rel='author' href='".$arrayGooglePlus['author']."' />";
		$google .= $googleAuthor;

	}

	if(isset($arrayGooglePlus['publisher']))
	{
		$googlePublisher ="<link rel='publisher' href='".$arrayGooglePlus['publisher']."' />";
		$google .= $googlePublisher;
	}
	
	return $google;
  }
}