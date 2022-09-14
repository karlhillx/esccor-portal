<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">
  <channel>
    <title>{{ config('app.name') }}</title>
    <link>{{ url()->current() }}</link>
    <description>{{ env('SITE_DESCRIPTION') }}</description>
    <atom:link href="{{ url()->current() }}" rel="self" type="application/rss+xml" />

  @foreach($recentEntries as $entry)
    <item>
        <title>{{ $entry['title'] }}</title>
        <link>{{ $entry['url'] }}</link>
        <guid isPermaLink="true">{{ $entry['id'] }}</guid>
        <description>{!! htmlspecialchars($entry['abstract']) !!}</description>
        <content:encoded><![CDATA[{!! $entry['abstract'] !!}]]></content:encoded>
        <dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/">{{ $entry['domain'] }}</dc:creator>
        <pubDate>{{ $entry['published']->format(DateTime::RSS) }}</pubDate>
      </item>
  @endforeach
  
  </channel>
</rss>