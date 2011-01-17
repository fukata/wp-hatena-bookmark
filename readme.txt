=== wp-flickr-press ===
Contributors: tatsuya
Donate link: http://fukata.org/
Tags: hatena,bookmark
Requires at least: 3.0.1
Tested up to: 3.0.1
Stable tag: 0.2.0

はてなブックマークの人気エントリー情報を表示するためのヘルパーメソッド群。

== Description ==

当プラグインは、WordPressのテンプレート内にはてなブックマークの人気エントリー情報を表示するためのヘルパーメソッドを提供します。。

最新のソースは、下記より取得できます。
http://github.com/fukata/wp-hatena-bookmark/

== Installation ==

1. 解凍後、フォルダ「wp-hatena-bookmark/」をディレクトリ「/wp-content/plugins/」にアップロードする。
2. 管理画面よりプラグイン「wp-hatena-bookmark」をアクティベートを行う。
3. テンプレートに以下のように記述することで、hatenaの人気記事ランキングを表示することができます。

<ul>
  <?php
    $entries = hatena_entries(get_bloginfo('url'), array('count'=>10, 'sort'=>'count')); 
    foreach ($entries as $entry) {
  ?>
  <li><a href="<?php echo $entry->link ?>"><?php echo $entry->title ?></a> <span class="hatena-bookmark-count"><a href="<?php echo "http://b.hatena.ne.jp/entry/".$entry->link ?>" target="_blank"><?php echo $entry->hatena_bookmarkcount ?>users</a></span></li>
  <?php } ?>
</ul>

== Frequently Asked Questions ==

現在なし

== Screenshots ==

== Changelog ==
= 0.2.0 =
* 対象URLのコンテンツをファイルにキャッシュするように修正

= 0.1.0 =
* 初回リリース
