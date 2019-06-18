<?php
  ini_set('display_error', 5);
  error_reporting(E_ALL);
  require_once 'inc/db.class.php';
  
  // Opvragen van alle posts in de database
  $posts = new db();
  $postData = $posts->getAllData('blogg');
  
  updateRss($postData);
  header('Location: index.php');

// Instantiate a XMLWriter object:

function updateRss($data){
  $xml = new XMLWriter();
  // Next open the file to which you want to write. For example, to write to /var/www/example.com/xml/output.xml, use:
  //$xml->openURI('file:///var/www/example.com/xml/output.xml');
  $xml->openURI('file:///rss.xml');
  // To start the document (create the XML open tag):
  $xml->startDocument('1.0', 'utf-8');
  // Set Indent to 4 spaces
  $xml->setIndent(4);

  // Create the RSS element
  $xml->startElement('rss');
      $xml->writeAttribute('version', '2.0');
          // Create the channel element
          $xml->startElement('channel');
              // Sets channel attributes
              $xml->writeElement('title', 'News Cast');
              $xml->writeElement('link', 'www.myRssFeeds.be');
              $xml->writeElement('description', 'NewsCast');
              $xml->writeElement('language', 'nl');
                // Create the image element
                $xml->startElement('image');
                    // Sets image attributes
                    $xml->writeElement('title', '');
                    $xml->writeElement('link','');
                    $xml->writeElement('url','');
                    $xml->writeElement('width','');
                    $xml->writeElement('height','');
                // Closes the image element
                $xml->endElement();
                // Create the image element

                addRssItems($xml,$data);

          // Closes the channel element
          $xml->endElement();
  // Closes the RSS element
  $xml->endElement();
}


function addRssItems($xml,$data){

for($index=0;$index<count($data);$index++){
  $xml->startElement('item');
      // Sets item attributes
      $xml->writeElement('title', $data[$index]['title']);
      //$xml->writeElement('pubDate', $data[$index]['datum']);
      //$xml->writeElement('link', $data[$index]['link']);
      $xml->writeElement('description', $data[$index]['body']);
      $xml->writeElement('author', '');
      $xml->writeElement('comments', '');
      $xml->writeElement('category', '');
      $xml->writeElement('author', '');
          // Create the enclosure element
          $xml->startElement('enclosure');
              // Sets enclosure attributes
              $xml->writeAttribute('url', 'http://www.myRssFeeds.be/podcast.mp4');
              $xml->writeAttribute('length', '19741854');
              $xml->writeAttribute('type', 'video/mpeg');
          // Closes the enclosure element
          $xml->endElement();
  // Closes the item element
  $xml->endElement();
}
}

?>
