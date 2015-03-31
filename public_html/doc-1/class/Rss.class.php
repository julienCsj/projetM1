<?php
class Rss{
	private $title,$link,$events;
	function __construct($title,$link){
		$this->title = $title;
		$this->link = $link;
		$this->events = array();
	}
	public function publish(){
		$link = 'http://projet.idleman.fr/PHPipe';
		$rss = '<?xml version="1.0" encoding="UTF-8"?>
		<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
		<channel>
					<title>'.$this->title.'</title>
					<atom:link href="'.$this->link.'" rel="self" type="application/rss+xml"/>
					<link>'.$this->link.'</link>
					<description>Aggrégation des flux</description>
					<language>fr-fr</language>
					<copyright>DWTFYW</copyright>
					<pubDate>'.date('r', gmstrftime(time())) .'</pubDate>
					<lastBuildDate>'.date('r', gmstrftime(time())) .'</lastBuildDate>
					<sy:updatePeriod>hourly</sy:updatePeriod>
					<sy:updateFrequency>1</sy:updateFrequency>
					<generator>'.$this->title.'</generator>';

			

			foreach($this->events as $event){
				$rss .= '<item>
						<title><![CDATA['.$event->title.']]></title>
						<link>'.$event->link.'</link>
						<pubDate>'.date('r', gmstrftime(strtotime($event->date))).'</pubDate>
						<guid isPermaLink="true">'.$event->link.'</guid>
						<description>
						<![CDATA['.$event->description.']]>
						</description>
						<content:encoded><![CDATA['.$event->content.']]></content:encoded>
						<category>'.implode('|',$event->categories).'</category>
						<dc:creator>'.$event->creator.'</dc:creator>
					</item>';

			}
			$rss .= '</channel></rss>';
			return $rss;
	}
	public function add($title,$date,$link,$content,$creator='Anonyme',$description='',$categories=array()){
			$event = (object) array();
			$event->guid = count($this->events)+1;
			$event->title = $title;
			$event->date = $date;
			$event->creator = $creator;
			$event->link = $link;
			$event->content = $content;
			$event->description = $description;
			$event->categories = $categories;
			if(trim($event->description)=='')
				$event->description = substr($event->content,0,300).'<br><a href="'.$event->link.'">Lire la suite</a>';
			if(trim($event->content)=='')
				$event->content = $event->description;
			
			$this->events[]= $event; 
	}
}





?>