========== ========== ==========
  setpano.htm  ver.1.0
========== ========== ==========

【 ソフト名 】パノラマ配置(β)
【 製 作 者 】岡山県立大学
【  種  別  】pcd作成用authoringソフト
【 開発環境 】htm
【 動作環境 】JavaScript が使用できるウェブブラウザ
【バージョン】1.0
【最終更新日】2009/09/14
【ファイル名】setpano.htm
---------- ----------
◇ 概要 ◇
パノラマ画像に関する情報を記述したXMLファイルを作成するauthoringソフト。
以下の情報を記述、
・パノラマID
・イメージ画像のファイル名
・画像の大きさ
・位置情報（経度・緯度）
・方位情報（北）

◇ 動作条件 ◇
・Apache HTTP Server 2.0 以上

◇ ファイル構成 ◇
http://localhost/authoring
｜  setpano.htm		【authoring用】
｜  pasq.php
｜  PTViewer.jar
｜  style.css
｜  DEWSptv.jar
｜  README.txt
｜  
｜
├—resource
｜　｜ ○○.jpg 	【pcd作成用パノラマ画像】
｜　｜  :
｜　｜ ○○.jpg
｜　└ pcd_opu.xml　	【pcd作成時に生成　現在ファイル名は固定】
｜
├—js
｜　｜ jkl-debug.js
｜　｜ jkl-parsexml.js
｜　｜ ObjTree.js
｜　｜ prototype.js
｜　└ xmlhttp.js
｜
└—image		【マーカーや地図画像】

◇ つかいかた ◇
・新規作成		マップの初期化
・読み込み		resourceフォルダ内のxmlファイルを開く
・保存			ファイルの保存（ファイル名をpcd_opu.xmlにする）
・方位情報設定		北情報を記述（画像の横ピクセルで設定）
・スタートパノ設定	PasQにて画像表示時に最初に表示するパノラマ画像・向きの設定
・パノラマ配置		resourceフォルダ内のパノラマ画像を１つずつ配置
・一括配置		開始・終了地点を決め、パノラマ画像を一括配置（一直線のみ）
・近傍パノラマ表示	切替え先・切替え範囲を表示
  
◇ FAQ・既知のバグ ◇
・pcd作成時のファイル名をpcd_opu.xmlにする必要あり。
・近傍パノラマ表示時、切替え先が１箇所しかない場合にエラー。

使い方の詳細ドキュメントを http://www.slideshare.net/kunishi/pcd-37446278 に置いているので、合わせて参照されたい。
----------
◇ 履歴 ◇
